<?php

return [
    'defaults' => [
        'guard' => 'vendeur',
        'passwords' => 'vendeurs',
    ],

    'guards' => [
        'vendeur' => [
            'driver' => 'session',
            'provider' => 'vendeurs',
        ],
    ],

    'providers' => [
        'vendeurs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Vendeur::class,
        ],
    ],

    'passwords' => [
        'vendeurs' => [
            'provider' => 'vendeurs',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
