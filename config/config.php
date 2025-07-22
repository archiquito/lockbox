<?php
return  [
    'database' => [
        'driver' => 'postgres',
        'host' => '127.0.0.1',
        'dbname' => 'dblockbox',
        'user' => 'lockbox',
        'password' => 'lockbox',
        'port' => 5432,
        'charset' => 'utf8mb4',

        // 'driver' => 'sqlite',
        // 'database' => base_path('database/db-lockbox.sqlite'),

        // 'driver' => 'mysql',
        // 'host' => '127.0.0.1',
        // 'dbname' => 'bookwise',
        // 'user' => 'root',
        // 'charset' => 'utf8mb4',
    ],
    'security' => [
        'first_key' => env('ENCRYPT_FIRST_KEY'),
        'second_key' => env('ENCRYPT_SECOND_KEY'),
    ]
];
