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

}
