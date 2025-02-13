<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Services\OrderService;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function __construct(protected OrderService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function __invoke(OrderStoreRequest $request)
    {
        $this->service->createOrder($request->validated());

        return response()->json([], Response::HTTP_OK);
    }
}
