<?php

namespace App;

use App\Models\BaseModel;
use Carbon\Carbon;


/**
 * Class Repetition
 *
 * @property int $id
 * @property int $card_id
 * @property int $iteration
 * @property int $status
 * @property Carbon $repeat_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Card $card
 *
 * @package App
 */
class Repetition extends BaseModel
{
    protected $table = 'repetitions';

    protected $fillable = [
        'card_id', 'iteration', 'repeat_at', 'status'
    ];

    protected $casts = [
        'card_id' => 'int',
        'iteration' => 'int',
        'repeat_at' => 'date',
        'status' => 'int',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

}