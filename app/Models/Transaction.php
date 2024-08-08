<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'trans_id',
        'description',
        'amount',
        'order_id',
        'withdrawal_id',
        'old_bal',
        'new_bal',
        'status',
        'symbol',
        'level',
        'created_at',
         'updated_at'
    ];
}
