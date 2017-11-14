<?php
/*
 |====================================================================================================
 | FRONTEND ROUTES
 |====================================================================================================
 | Frontend routes
 |
 */
$app->group('', function () {
    $this->get('/', ['App\\Modules\\Site\\Http\\Controllers\\HomeController', 'index'])->setName('home');
});