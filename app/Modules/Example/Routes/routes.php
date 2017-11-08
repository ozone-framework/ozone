<?php
use App\Example\Http\Middlewares\ExampleMiddleware;
/*
 |====================================================================================================
 | FRONTEND ROUTES
 |====================================================================================================
 | Frontend routes
 |
 */
$app->group('/example', function () {
    $this->get('', ['App\\Example\\Http\\Controllers\\ExampleController', 'index'])->setName('example');
})->add(ExampleMiddleware::class);
