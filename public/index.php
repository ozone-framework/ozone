<?php
/*
 |==================================================================
 | Application root directory
 |==================================================================
 |
 * */
define('ROOT', getcwd() . '/');

// Start PHP session
(session_id()) != '' ? session_start() : null;

/*
 |==================================================================
 | Vendor autoload
 |==================================================================
 |
 * */
require_once ROOT . '../vendor/autoload.php';

/*
 |==================================================================
 | Environment File
 |==================================================================
 |
 * */
$dotEnv = new Dotenv\Dotenv('../');
$dotEnv->load();

/*
 |==================================================================
 | Bootstrap file
 |==================================================================
 |
 * */
require_once ROOT . '../config/start.php';

$app = new \Core\Framework();

/*
 |==================================================================
 | Routes
 |==================================================================
 |
 * */
require_once ROOT . '../config/Core/routes.php';

$app->run();
