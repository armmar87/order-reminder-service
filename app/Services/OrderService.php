<?php

namespace App\Services;

use App\Enums\OrderType;
use App\Models\Order;
use Carbon\Carbon;

class OrderService
{
    public function __construct(protected Order $model) {}

    public function createOrder(array $data): void {
        $order = $this->model->fill($data);
        $order->expiration_date = $this->calculateExpirationDate($data['type'], $data['application_date']);
        $order->save();
    }

    private function calculateExpirationDate(OrderType $type, Carbon $applicationDate): Carbon {
        return match ($type) {
            OrderType::TYPE_X => $applicationDate->addYear(),
            OrderType::TYPE_Y => Carbon::create($applicationDate->year, 12, 31),
        };
    }
}
