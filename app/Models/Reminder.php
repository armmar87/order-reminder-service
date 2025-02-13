<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'order_id',
        'reminder_date',
        'is_sent'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
