<?php

namespace App\Actions;

use App\Jobs\OrderPrepared;

class UpdateStatusOrder
{
    public function handle($order, $status)
    {
        $order->status = $status;
        $order->save();

        OrderPrepared::dispatch($order)->delay(5)->onQueue('order_updates');

        return $order;
    }

}
