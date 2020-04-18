<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Deck
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property Collection<Card> $cards
 *
 * @package App
 */
class Deck extends BaseModel
{
    protected $table = 'decks';

    protected $fillable = [
        'title', 'status'
    ];

    protected $casts = [
        'status' => 'int'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
