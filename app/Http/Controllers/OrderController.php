<?php

namespace App\Http\Controllers;

use App\Actions\UpdateStatusOrder;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate();
        return response()->json($orders);
    }

    public function update(UpdateOrderRequest $orderRequest, Order $order, UpdateStatusOrder $updateStatusOrder)
    {
        $order = $updateStatusOrder->handle($order, $orderRequest->get('status'));
        return response()->json($order);
    }
}
