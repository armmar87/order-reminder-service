<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \App\Enums\OrderType;

class Order extends Model
{
    protected $fillable = ['business_name', 'type', 'application_date', 'expiration_date', 'is_replaced'];

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function calculateExpirationDate()
    {
        if ($this->order_type === OrderType::X->value) {
            return $this->application_date->addYear();
        } elseif ($this->order_type === OrderType::Y->value) {
            return Carbon::create($this->application_date->year, 12, 31);
        }
        return null;
    }
}
