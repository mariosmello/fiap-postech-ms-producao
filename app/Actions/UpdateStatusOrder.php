<?php

namespace App\Actions;

use App\Jobs\OrderPreparationFailed;
use App\Jobs\OrderPrepared;

class UpdateStatusOrder
{
    public function handle($order, $status)
    {
        $order->status = $status;
        $order->save();

        if ('ready' == $status) {
            OrderPrepared::dispatch($order)->delay(5)->onQueue('order_updates');
        } else {
            OrderPreparationFailed::dispatch($order)->delay(5)->onQueue('order_updates');
        }

        return $order;
    }

}
