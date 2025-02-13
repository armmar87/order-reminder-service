<?php

namespace Tests\Feature;

use App\Enums\OrderType;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order()
    {
        $response = $this->postJson('/api/orders', [
            'user_id' => 1,
            'type' => OrderType::TYPE_X,
            'application_date' => now(),
            'business' => 'business 1',
        ]);

        dd($response->getStatusCode());
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('orders', ['order_type' => OrderType::TYPE_X]);
    }
}
