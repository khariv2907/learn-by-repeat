<?php

namespace App\Http\Controllers;

use App\Services\RepetitionService;
use Illuminate\Http\Request;

class RepetitionController extends Controller
{
    public RepetitionService $repetitionService;

    public function __construct(RepetitionService $repetitionService)
    {
        $this->repetitionService = $repetitionService;
    }

    public function doneRepetition(int $id)
    {
        try {
            $this->repetitionService->doneRepetition($id);

            return redirect()->route('home')->withSuccess('Repetition has done!');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function postponeRepetition(int $id, int $days)
    {
        try {
            $this->repetitionService->postponeRepetition($id, $days);

            return redirect()->route('home')->withSuccess('Repetition has postponed!');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function closeDay()
    {
        try {
            $this->repetitionService->closeDay();

            return redirect()->route('home')->withSuccess('Repetition has postponed!');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }
}
