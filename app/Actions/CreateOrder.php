<?php

namespace App\Actions;

use App\Jobs\OrderPreparationFailed;
use App\Models\Order;


class CreateOrder
{
    public function handle($order)
    {
        $pOrder = new Order();
        $pOrder->code = $order['code'];
        $pOrder->status = 'pending';

        $products = [];

        foreach ($order['products'] as $item) {
            $product = new \App\Models\Product();
            $product->id = $item['id'];
            $product->name = $item['name'];
            $product->category = $item['category'];
            $product->qty = $item['qty'];
            $products[] = $product->toArray();
        }

        $pOrder->products = $products;
        $pOrder->save();

        if (count($products) > 3) {
            $pOrder->status = 'cancelled';
            $pOrder->save();
            OrderPreparationFailed::dispatch($pOrder)->delay(5)->onQueue('order_updates');
        }

    }

}
