<?php
/*
 |==================================================================
 | Autoload routes file from every modules
 |==================================================================
 |
 * */
require_once ROOT . '../config/Core/Helpers.php';

$routeDirs = getDir(ROOT . '../app/Modules/', 'Routes');

foreach ($routeDirs as $route) {
    $routePath = $route . '/routes.php';
    if (file_exists($routePath)) {
        include $routePath;
    }
}
