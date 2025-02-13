<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\ReminderService;

class OrderObserver
{
    public function __construct(protected ReminderService $reminderService)
    {

    }
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $this->reminderService->scheduleReminders($order);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $this->reminderService->scheduleReminders($order);
    }
}
