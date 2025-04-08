<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    protected $fillable = [
        'total_cash',
        'total_card',
        'deposit_cash',
        'deposit_card',
        'free_cash' // Вычисляемое поле: total_cash - deposit_cash
    ];
}
