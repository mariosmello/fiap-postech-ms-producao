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
