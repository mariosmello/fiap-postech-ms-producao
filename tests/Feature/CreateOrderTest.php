<?php

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can create a order', function () {

    $data = [
        "_id" => "66411f62d9fd02b9f001fd82",
        "status" => "pending",
        "payment_status" => "paid",
        "code" => "2819",
        "products" => [
            [
                "id" => 1,
                "name" => "Name",
                "category" => [
                    "id" => 1,
                    "name" => "Name"
                ],
                "qty" => 3
            ]
        ]
    ];

    $createOrder = new \App\Actions\CreateOrder();
    $createOrder->handle($data);

});
