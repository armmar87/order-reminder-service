<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Enums\ReminderIntervalType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminder_intervals', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [ReminderIntervalType::PRE->value, ReminderIntervalType::POST->value]);
            $table->integer('days');
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminder_intervals');
    }
};
