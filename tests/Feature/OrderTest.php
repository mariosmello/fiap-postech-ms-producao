<?php

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

beforeEach(function () {
    $this->token = \Firebase\JWT\JWT::encode([
        'sub' => '1',
        'name' => fake()->name(),
        'email' => fake()->email(),
    ], env('JWT_SECRET'), 'HS256');
});

it('can list orders', function () {
    $this->getJson(
        route('orders.index'),
        ['Authorization' => 'Bearer ' . $this->token]
    )->assertStatus(200);
});


it('can update an order', function () {

    \Illuminate\Support\Facades\Queue::fake();

    $order = \App\Models\Order::create(['status' => 'pending']);

    $this->putJson(
        route('orders.update', ['order' => $order->getIdAttribute()]),
        ['status' => 'ready'],
        ['Authorization' => 'Bearer ' . $this->token]
    )->assertStatus(200);
});
