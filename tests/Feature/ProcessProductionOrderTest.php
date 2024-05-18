<?php

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can update order status', function () {

    \Illuminate\Support\Facades\Queue::fake();

    $job = new \App\Jobs\ProcessProductionOrder([
        'code' => '12345',
        'products' => [
            [
                'id' => 1,
                'name' => 'Name',
                'category' => [
                    'id' => 1,
                    'name' => 'Name',
                ],
                'qty' => 1
            ]
        ],
    ]);
    $job->handle(new \App\Actions\CreateOrder());

    $this->assertCount(1, \App\Models\Order::where('code', '12345')->get());

});
