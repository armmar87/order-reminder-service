<?php

namespace App\Console\Commands;

use App\Mail\ExpirationReminderEmail;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send scheduled reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminder::with('order')
            ->where('is_sent', false)
            ->where('reminder_date', '<=', now())
            ->get();

        foreach ($reminders as $reminder) {
            Mail::to($reminder->order->user->email)->send(new ExpirationReminderEmail($reminder));

            $reminder->update(['is_sent' => true]);
        }
    }
}
