<?php


namespace App\Services;


use App\Models\BaseModel;
use App\Models\Card;
use DB;

class CardService
{
    /**
     * Change card status
     */
    public function changeStatus(int $id) : bool
    {
        $card = Card::findOrFail($id);

        $card->status = $card->status
            ? Card::STATUS_INACTIVE
            : Card::STATUS_ACTIVE;

        return $card->save();
    }

    /**
     * Move card repetition to done
     */
    public function doneRepetition(int $id)
    {
        $card = Card::findOrFail($id);
        $nearestRepetition = $card->nearestRepetition;
        $nextIteration = $this->getNextIteration($nearestRepetition->iteration);

        DB::transaction(function () use ($card, $nextIteration) {
            $card->nearestRepetition()->update(['status' => Card::STATUS_INACTIVE]);
            $card->repetitions()->create([
                'iteration' => $nextIteration,
                'status' => BaseModel::STATUS_ACTIVE,
                'repeat_at' => now()->addDays($nextIteration)
            ]);
        }, 5);
    }

    /**
     * Get next iteration
     */
    protected function getNextIteration(int $lastIteration) : int
    {
        $days = collect(config('params.repeat_iterations'))->sortBy('after_days');
        $lastDay = $days->last()['after_days'];

        if ($lastIteration === $lastDay) {
            return $lastIteration;
        }

        return $days->firstWhere('after_days', '>', $lastIteration)['after_days'];
    }

}
