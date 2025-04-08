<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseStatusHistory extends Model
{
    protected $fillable = [
        'house_id',
        'previous_status',
        'new_status',
        'changed_by'
    ];

    protected $casts = [
        'changed_at' => 'datetime'
    ];
}
