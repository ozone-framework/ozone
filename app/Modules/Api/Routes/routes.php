<?php

/*
 |====================================================================================================
 | API
 |====================================================================================================
 | All Routes  begin with api prefix
 |
 */

// VER 1.0
$app->group('/api/v1', function () {
    $this->get('/demo', ['App\\Modules\\Api\\Http\\Controllers\\ApiController', 'index']);
});

// VER 2.0
$app->group('/api/v2', function () {
    $this->get('/demo', ['App\\Modules\\Api\\Http\\Controllers\\ApiController', 'index']);
});