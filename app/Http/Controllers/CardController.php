<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }
}
