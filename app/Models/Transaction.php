<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'house_id',
        'type', // checkin, checkout, adjustment
        'cash_payment',
        'card_payment',
        'cash_deposit',
        'card_deposit',
        'notes'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
