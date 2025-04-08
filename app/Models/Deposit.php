<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'house_id',
        'cash_amount',
        'card_amount',
        'returned_at',
        'is_returned'
    ];

    protected $casts = [
        'is_returned' => 'boolean'
    ];
}
