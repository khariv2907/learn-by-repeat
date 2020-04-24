<?php


namespace App\Services;


use App\Models\BaseModel;
use App\Models\Repetition;
use DB;

class RepetitionService
{
    /**
     * Move card repetition to done
     */
    public function doneRepetition(int $id)
    {
        /** @var Repetition $repetition */
        $repetition = Repetition::with('card.lastDoneRepetition', 'card.firstPostponeRepetition')->findOrFail($id);
        $newIteration = $this->getNewIteration($repetition);

        DB::transaction(function () use ($repetition, $newIteration) {
            $repetition->update(['status' => Repetition::STATUS_DONE]);

            Repetition::create([
                'card_id' => $repetition->card_id,
                'iteration' => $newIteration,
                'status' => Repetition::STATUS_ACTIVE,
                'repeat_at' => now()->addDays($newIteration)
            ]);
        }, 5);
    }

    /**
     * Postpone repetition
     */
    public function postponeRepetition(int $id, int $days)
    {
        $repetition = Repetition::findOrFail($id);

        DB::transaction(function () use ($repetition, $days) {
            $repetition->update(['status' => Repetition::STATUS_POSTPONED]);

            Repetition::create([
                'card_id' => $repetition->card_id,
                'iteration' => $days,
                'status' => Repetition::STATUS_ACTIVE,
                'is_postponement' => true,
                'repeat_at' => now()->addDays($days)
            ]);
        }, 5);
    }

    /**
     * Close day
     */
    public function closeDay()
    {
        $postponedRepetitions = [];
        $repetitionsBuilder = Repetition::active()->whereDate('repeat_at', '<=', now());
        $cardsIdList = $repetitionsBuilder->pluck('card_id');

        if (!empty($cardsIdList)) {
            // postponed repetitions data
            foreach ($cardsIdList as $cardId) {
                $postponedRepetitions[] = [
                    'card_id' => $cardId->card_id,
                    'iteration' => 1,
                    'status' => BaseModel::STATUS_ACTIVE,
                    'is_postponement' => true,
                    'repeat_at' => date_create('tomorrow')
                ];
            }

            DB::transaction(function () use ($repetitionsBuilder, $postponedRepetitions){
                $repetitionsBuilder->update(['status' => Repetition::STATUS_POSTPONED]);
                Repetition::createMany($postponedRepetitions);
            }, 5);
        }
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

    /**
     * Get new iteration
     * It depends on whether the repetition has been postponed
     */
    protected function getNewIteration(Repetition $repetition) : int
    {
        $res = null;
        $lastDoneRepetition = $repetition->card->lastDoneRepetition;

        if (!empty($lastDoneRepetition)) {
            if ($repetition->is_postponement) {
                $firstPostponeRepetition = $repetition->card->firstPostponeRepetition;
                $previousIteration = $lastDoneRepetition->iteration;
                $nextIteration = $this->getNextIteration($firstPostponeRepetition->iteration);

                $daysFromFirstPostpone = (int) $firstPostponeRepetition
                    ->repeat_at
                    ->diff(now())
                    ->format('%a');

                if ($firstPostponeRepetition->iteration < 7) {
                    if ($daysFromFirstPostpone < 7) {
                        $res = $firstPostponeRepetition->iteration; // same (postponed) iteration

                    } else if ($daysFromFirstPostpone <= 30) {
                        $res = $previousIteration;
                    }

                } else if ($firstPostponeRepetition->iteration <= 30) {
                    if ($daysFromFirstPostpone < 7) {
                        $res = $nextIteration;

                    } else if ($daysFromFirstPostpone <= 30) {
                        $res = $previousIteration;
                    }

                } else {
                    $res = ($daysFromFirstPostpone <= 30) ? $nextIteration : $previousIteration;
                }

            } else {
                $res = $this->getNextIteration($repetition->iteration);
            }
        }

        return $res ?? 1;
    }

}
