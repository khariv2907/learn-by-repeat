<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function changeStatus(int $id)
    {
        try {
            $this->cardService->changeStatus($id);

            return redirect()->route('decks')->withSuccess('Card has updated!');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function ajaxViewHistory(Request $request)
    {
        $id = $request->get('id');
        $card = Card::findOrFail($id);
        $repetitions = $card->repetitions;

        return view('deck._partials.repetition-history-modal', compact('repetitions'));
    }
}
