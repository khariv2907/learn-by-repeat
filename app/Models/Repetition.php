<?php

namespace App\Models;

use App\Models\BaseModel;
use Carbon\Carbon;


/**
 * Class Repetition
 *
 * @property int $id
 * @property int $card_id
 * @property int $iteration
 * @property int $status
 * @property bool $is_postponement
 * @property Carbon $repeat_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Card $card
 *
 * @package App
 */
class Repetition extends BaseModel
{
    const STATUS_DONE = 2;
    const STATUS_POSTPONED = 3;

    protected $table = 'repetitions';

    protected $fillable = [
        'card_id', 'iteration', 'repeat_at', 'status', 'is_postponement'
    ];

    protected $dates = [
        'repeat_at', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'card_id' => 'int',
        'iteration' => 'int',
        'repeat_at' => 'date',
        'status' => 'int',
        'is_postponement' => 'bool',
    ];

    public function getRepeatAtAttribute($value)
    {
        return  date_create($value)->format('d-m-Y');
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

}
