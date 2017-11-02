<?php
/*
 |====================================================================================================
 | FRONTEND ROUTES
 |====================================================================================================
 | Frontend routes
 |
 */
$app->group('/example', function () {
    $this->get('', ['App\\Example\\Http\\Controllers\\ExampleController', 'index'])->setName('example')->add(\Acme\Middleware\AppMiddleware::class);
});