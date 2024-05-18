<?php

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can create a order', function () {

    \Illuminate\Support\Facades\Queue::fake();

    $order = \App\Models\Order::create(['status' => 'pending']);
    $targetStatus = 'ready';

    $createOrder = new \App\Actions\UpdateStatusOrder();
    $createOrder->handle($order, $targetStatus);
    $order->refresh();

    $this->assertEquals($targetStatus, $order->status);

});
