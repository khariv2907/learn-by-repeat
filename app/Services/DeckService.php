<?php


namespace App\Services;


use App\Models\BaseModel;
use App\Models\Deck;
use App\Models\Repetition;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class DeckService
{

    public function getActiveDecks() : ?Collection
    {
        return Deck::with(['cards' => function($query) {
            $query->orderByDesc('status')
                ->orderBy('created_at')
                ->with('nearestRepetition');
        }])
            ->orderByDesc('status')
            ->orderBy('updated_at')
            ->get();
    }

    /**
     * Get repetitions by date
     */
    public function getRepetitionByDate(DateTime $date) : ?Collection
    {
        $whereFunc = function ($cardQuery) use ($date) {
            $cardQuery->active()->whereHas('repetitions', function ($repetitionQuery) use ($date) {
                $repetitionQuery->active()->whereDate('repeat_at', $date);
            });
        };

        return Deck::active()->whereHas('cards', $whereFunc)->with(['cards' => $whereFunc])->get();
    }

    /**
     * Create decks with cards
     */
    public function createWithCards(array $data) : void
    {
        DB::transaction(function () use ($data) {
            $repetitionsData = [];

            $deck = Deck::create($data);
            $cards = $deck->cards()->createMany($data['cards']);

            foreach ($cards as $index => $card) {
                $repetitionsData[] = [
                    'card_id' => $card->id,
                    'iteration' => 0,
                    'repeat_at' => now()->addDays($index+1),
                    'created_at' => now()
                ];
            }

            $repetitions = Repetition::insert($repetitionsData);
        }, 5);
    }

    /**
     * Disable Deck
     */
    public function changeStatus(int $id)
    {
        $deck = Deck::findOrFail($id);

        $deck->status = $deck->status
            ? BaseModel::STATUS_INACTIVE
            : BaseModel::STATUS_ACTIVE;

        $deck->save();
    }

}
