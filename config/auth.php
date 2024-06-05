<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        
        'administrators' => [
            'driver' => 'session',
            'provider' => 'administrators',
        ],
        'regadmin' => [
            'driver' => 'session',
            'provider' => 'regadmin',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        
        'administrators' => [
            'driver' => 'eloquent',
            'model' => App\Models\Administrator::class,
        ],
        'regadmin' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\RegionalAdmin::class),
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        
    ],

    'password_timeout' => 10800,
];
