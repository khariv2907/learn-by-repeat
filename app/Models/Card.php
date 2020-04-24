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
 * @property Repetition nearestRepetition
 * @property Repetition lastDoneRepetition
 * @property Repetition firstPostponeRepetition
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

    public function nearestRepetition()
    {
        return $this->hasOne(Repetition::class)
            ->where('status', Repetition::STATUS_ACTIVE)
            ->orderBy('repeat_at');
    }

    public function lastRepetition()
    {
        return $this->hasOne(Repetition::class)
            ->where('status', Repetition::STATUS_DONE)
            ->orderByDesc('repeat_at');
    }

    public function lastDoneRepetition()
    {
        return $this->hasOne(Repetition::class)
            ->where('status', Repetition::STATUS_DONE)
            ->orderByDesc('repeat_at');
    }

    public function firstPostponeRepetition()
    {
        return $this->hasOne(Repetition::class)
            ->where('status', Repetition::STATUS_POSTPONED)
            ->where('is_postponement', false)
            ->orderByDesc('repeat_at');
    }
}
