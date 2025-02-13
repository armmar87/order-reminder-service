<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateIntervalsRequest;
use App\Models\NotificationInterval;
use Illuminate\Http\Request;

class NotificationIntervalController extends Controller
{
    public function updateIntervals(UpdateIntervalsRequest $request)
    {
        NotificationInterval::truncate();

        // Create new ones
        foreach ($request->validated['intervals'] as $interval) {
            NotificationInterval::create($interval);
        }

        return response()->json(['message' => 'Intervals updated']);
    }
}
