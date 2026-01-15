<?php

namespace App\config;

class Config {
    private static $config = [
        'database' => [
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'test_db',
            'username' => '',
            'password' => '',
            'charset' => 'utf8mb4',
        ],
        'app' => [
            'name' => 'Order Management System',
            'version' => '1.0.0'
        ]
    ];

    public static function get($key) {
        return self::$config[$key] ?? null;
    }
}