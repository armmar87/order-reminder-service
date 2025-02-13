<?php

namespace Database\Seeders;

use App\Enums\ReminderIntervalType;
use App\Models\NotificationInterval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pre = ReminderIntervalType::PRE->value;
        $post = ReminderIntervalType::POST->value;

        NotificationInterval::createMany([
            ['type' => $pre, 'days' => 7],
            ['type' => $pre, 'days' => 3],
            ['type' => $pre, 'days' => 1],
            ['type' => $post, 'days' => 1],
        ]);
    }
}
