<?php
use App\Modules\Example\Http\Middlewares\ExampleMiddleware;
/*
 |====================================================================================================
 | FRONTEND ROUTES
 |====================================================================================================
 | Frontend routes
 |
 */
$app->group('/example', function () {
    $this->get('', ['App\\Modules\\Example\\Http\\Controllers\\ExampleController', 'index'])->setName('example');
    $this->get('/validate', ['App\\Modules\\Example\\Http\\Controllers\\ExampleController', 'validate'])->setName('validate');
    $this->post('/validate', ['App\\Modules\\Example\\Http\\Controllers\\ExampleController', 'validate'])->setName('validate.post');
})->add(ExampleMiddleware::class);
