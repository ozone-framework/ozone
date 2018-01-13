<?php

require_once 'Core/Helpers.php';

return [

    'app' => [
        'settings.httpVersion' => '1.1',
        'settings.responseChunkSize' => 4096,
        'settings.outputBuffering' => 'append',
        'settings.determineRouteBeforeAppMiddleware' => false,
        'settings.displayErrorDetails' => (getenv('APP_ENV', 'production') == 'development') ? true : false,
        'settings.debug' => getenv('APP_DEBUG', false),
        'settings.addContentLengthHeader' => true,
        'settings.routerCacheFile' => false,
        'settings' => [
            'httpVersion' => DI\get('settings.httpVersion'),
            'responseChunkSize' => DI\get('settings.responseChunkSize'),
            'outputBuffering' => DI\get('settings.outputBuffering'),
            'determineRouteBeforeAppMiddleware' => DI\get('settings.determineRouteBeforeAppMiddleware'),
            'displayErrorDetails' => DI\get('settings.displayErrorDetails'),
            'addContentLengthHeader' => DI\get('settings.addContentLengthHeader'),
            'routerCacheFile' => DI\get('settings.routerCacheFile'),
        ],
    ],
    'template' => [
        'cache' => __DIR__ . '/../storage/cache/template',//ROOT . 'storage/Cache/twig'
        'debug' => (getenv('APP_ENV', false) == 'development') ? true : false,
        'auto_reload'=>(getenv('APP_ENV', false) == 'development') ? true : false
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
            'proxy_dir' => getcwd() . '/../storage/cache/proxies',
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
    /*
     |==================================================================
     | Commands Class
     |==================================================================
     |
     * */
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
        //'123.345.567'
    ],
    /*
     |==================================================================
     | Blocked Ips
     |==================================================================
     |
     * */
    'blocked_ips' => [
        //'123.345.567',
    ]
];
