<?php

namespace App\Services;

use App\Enums\OrderType;
use App\Models\Order;
use Carbon\Carbon;

class OrderService
{
    public function __construct(protected Order $model) {}

    public function createOrder(array $data): Order {

        $existingOrder = $this->model::where('user_id', $data['user_id'])
            ->with('reminders')
            ->where('type', $data['type'])
            ->where('is_replaced', false)
            ->exist();

        if ($existingOrder && $existingOrder->expiration_date->isFuture()) {
            $existingOrder->update([
                'expiration_date' => $this->calculateExpirationDate($data['type'], $data['application_date']),
                'is_replaced' => true
            ]);

            $existingOrder->reminders()->delete();
        }

        // Create new order
        return $this->model::create($data);
    }

    private function calculateExpirationDate(OrderType $type, Carbon $applicationDate): Carbon {
        return match ($type) {
            OrderType::TYPE_X => $applicationDate->addYear(),
            OrderType::TYPE_Y => Carbon::create($applicationDate->year, 12, 31),
        };
    }
}
