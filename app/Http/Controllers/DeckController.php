<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeckRequest;
use App\Models\Deck;
use App\Services\DeckService;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    public DeckService $deckService;

    public function __construct(DeckService $deckService)
    {
        $this->deckService = $deckService;
    }

    public function dashboard()
    {
        $today = $this->deckService->getTodayRepetition();
        $yesterday = $this->deckService->getYesterdayRepetition();
        $tomorrow = $this->deckService->getTomorrowRepetition();

        return view('deck.dashboard', compact('today', 'yesterday', 'tomorrow'));
    }

    public function decks()
    {
        $decks = Deck::with('cards.nearestRepetition')->get();

        return view('deck.decks', compact('decks'));
    }

    public function createForm()
    {
        return view('deck.create-form');
    }

    public function store(CreateDeckRequest $request)
    {
        try {
            $this->deckService->createWithCards($request->validated());

            return redirect()->route('decks')->withSuccess('Deck has added!');

        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }
}
