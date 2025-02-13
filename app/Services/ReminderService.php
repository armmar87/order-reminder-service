<?php

namespace App\Services;

use App\Enums\ReminderIntervalType;
use App\Models\NotificationInterval;
use App\Models\Order;
use App\Models\Reminder;

class ReminderService
{
    public function __construct(protected Reminder $model) {}

    public function scheduleReminders(Order $order)
    {
        $intervals = NotificationInterval::whereIn('type', [
            ReminderIntervalType::PRE->value,
            ReminderIntervalType::POST->value
        ])->get();

        $reminders = $intervals->map(function ($interval) use ($order) {
            return [
                'order_id' => $order->id,
                'reminder_date' => $interval->type === ReminderIntervalType::PRE->value
                    ? $order->expiration_date->copy()->subDays($interval->days)
                    : $order->expiration_date->copy()->addDays($interval->days),
                'type' => $interval->type,
                'sent' => false,
                'created_at' => now(),
                'updated_at' => now()
            ];
        });

        // Batch insert if there are reminders
        if ($reminders->isNotEmpty()) {
            $this->model::insert($reminders->toArray());
        }
    }
}
