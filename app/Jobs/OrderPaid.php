<?php

namespace App\Jobs;

use App\Actions\CreateOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderPaid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct($order) {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(CreateOrder $createOrder): void
    {
        $createOrder->handle($this->order);
    }
}
