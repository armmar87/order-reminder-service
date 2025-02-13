<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Enums\OrderType;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $fillable = [
        'business',
        'type',
        'application_date',
        'expiration_date',
        'user_id',
    ];

    protected $casts = [
        'type' => OrderType::class,
        'application_date' => 'datetime',
        'expiration_date' => 'datetime',
    ];


    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function intervals()
    {
        return $this->belongsToMany(NotificationInterval::class);
    }
}
