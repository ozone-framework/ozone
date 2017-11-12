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
    $this->get('/validate', ['App\\Example\\Http\\Controllers\\ExampleController', 'validate'])->setName('validate');
    $this->post('/validate', ['App\\Example\\Http\\Controllers\\ExampleController', 'validate'])->setName('validate.post');
})->add(ExampleMiddleware::class);
