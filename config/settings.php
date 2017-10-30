<?php
/*
  |==================================================================
  | Autoload Entity Folder from module directory.
  |==================================================================
  |
  * */
$modulePath = getcwd() . '/app/Modules/';
$_directories = glob($modulePath . "*");
$entityDirs = [];

foreach ($_directories as $dir) {

    $modules = str_replace($modulePath, '', $dir);
    $entity = 'app/Modules/' . $modules . '/Entity';

    if (is_dir($entity)) {
        $entityDirs[] = $entity;
    }
}


return [

    /*
     |==================================================================
     | Doctrine Orm Configuration
     |==================================================================
     |
     * */
    'doctrine' => [
        'meta' => [
            'entity_path' => $entityDirs,
            'auto_generate_proxies' => true,
            'proxy_dir' => ROOT . '../storage/cache/proxies',
            'cache' => null,
        ],
        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => getenv('DB_HOST', 'localhost'),
            'dbname' => getenv('DB_DATABASE', 'your_db'),
            'user' => getenv('DB_USERNAME', 'root'),
            'password' => getenv('DB_PASSWORD', ''),
            'defaultDatabaseOptions' => [
                'charset' => 'utf8',
                'collate' => 'utf8_unicode_ci'
            ]
        ]
    ]
];
