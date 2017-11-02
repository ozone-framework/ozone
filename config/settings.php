<?php

require_once 'Core/Helpers.php';

return [

    'app' => [

    ],
    'template' => [

    ],
    /*
     |==================================================================
     | Doctrine ORM Configuration
     |==================================================================
     |
     * */
    'database' => [

        'meta' => [
            'entity_path' => getDir(getcwd() . '/app/Modules/', 'Entity'),
            'auto_generate_proxies' => true,
            'proxy_dir' => getcwd() . '../storage/cache/proxies',
            'cache' => null,
        ],
        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => getenv('DB_HOST', 'localhost'),
            'dbname' => getenv('DB_DATABASE', 'your_db'),
            'user' => getenv('DB_USERNAME', 'root'),
            'password' => getenv('DB_PASSWORD', ''),
            'defaultDatabaseOptions' => [
                'charset' => getenv('DB_CHARSET', 'utf8'),
                'collate' => getenv('DB_COLLATE', 'utf8_unicode_ci')
            ]
        ]
    ],
    'commands' => [

    ],
    /*
     |==================================================================
     | Encryption Keys
     |==================================================================
     |
     * */
    'encryption' => [
        'secret_key' => ',i-t]aNgl4;FTPxco,AIKN(`):S0b6',
        'secret_iv' => 'A4o[PH>i=s+1GVPg&>^EYImP=^nLd5'
    ],
    /*
     |==================================================================
     | Allowed Ips
     |==================================================================
     |
     * */
    'allowed_ips' => [
        '123.345.567',
    ],
    /*
     |==================================================================
     | Blocked Ips
     |==================================================================
     |
     * */
    'blocked_ips' => [
        '123.345.567',
    ]

];
