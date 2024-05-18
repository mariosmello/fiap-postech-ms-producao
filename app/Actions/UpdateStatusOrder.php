<?php

namespace App\Actions;

use App\Jobs\ProcessProductionOrderStatus;

class UpdateStatusOrder
{
    public function handle($order, $status)
    {
        $order->status = $status;
        $order->save();

        ProcessProductionOrderStatus::dispatch($order)->delay(2)->onQueue('productions');

        return $order;
    }

}
