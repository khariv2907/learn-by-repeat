<?php

namespace App\Http\Controllers;

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
        return view('deck.dashboard');
    }

    public function decks()
    {
        return view('deck.decks');
    }

    public function createForm()
    {
        return view('deck.create-form');
    }

    public function create()
    {
        return view('deck.alternative-create-form');
    }
}
