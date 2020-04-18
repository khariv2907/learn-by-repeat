<?php


namespace App\Services;


use App\Models\Deck;
use App\Models\Repetition;
use DB;
use Illuminate\Database\Eloquent\Builder;

class DeckService
{

    public function getTodayRepetition()
    {
        $date = now();

        return $this->getRepetitionByDate($date);
    }

    public function getYesterdayRepetition()
    {
        $date = date_create('yesterday');

        return $this->getRepetitionByDate($date);
    }

    public function getTomorrowRepetition()
    {
        $date = date_create('tomorrow');

        return $this->getRepetitionByDate($date);
    }

    protected function getRepetitionByDate($date)
    {
        return Deck::active()->whereHas('cards', function (Builder $cardQuery) use ($date) {
            $cardQuery->active()->whereHas('repetitions', function (Builder $repetitionQuery) use ($date) {
                $repetitionQuery->active()->whereDate('repeat_at', $date);
            });
        })->with(['cards' => function($cardQuery) use ($date) {
            $cardQuery->active()->whereHas('repetitions', function ($repetitionQuery) use ($date) {
                $repetitionQuery->active()->whereDate('repeat_at', $date);
            })->with('repetitions');
        }])->get();
    }

    public function createWithCards(array $data) : void
    {
        DB::transaction(function () use ($data) {
            $repetitionsData = [];

            $deck = Deck::create($data);
            $cards = $deck->cards()->createMany($data['cards']);

            foreach ($cards as $index => $card) {
                $repetitionsData[] = [
                    'card_id' => $card->id,
                    'iteration' => 1,
                    'repeat_at' => now()->addDays($index+1),
                ];
            }

            $repetitions = Repetition::insert($repetitionsData);
        }, 5);
    }

}
