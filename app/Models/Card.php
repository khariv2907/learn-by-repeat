<?php

namespace App\Models;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Card
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $deck_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Deck $deck
 * @property Collection<Repetition> $repetitions
 *
 * @package App
 */
class Card extends BaseModel
{
    protected $table = 'cards';

    protected $fillable = [
       'title', 'content', 'deck_id', 'status'
    ];

    protected $casts = [
        'status' => 'int',
        'deck_id' => 'int',
    ];

    public function deck()
    {
        return $this->belongsTo(Deck::class);
    }

    public function repetitions()
    {
        return $this->hasMany(Repetition::class);
    }
}
