<?php

use Core\ErrorHandler;
use Core\NotFoundHandler;
use Core\NotAllowedHandler;
use Dopesong\Slim\Error\Whoops;
use Psr\Container\ContainerInterface;

return [
    /*
     |---------------------------------------------------------------------------------------------
     | Error Handler File
     |---------------------------------------------------------------------------------------------
     |
     */
    'notFoundHandler' => function (ContainerInterface $container) {
        return new NotFoundHandler();
    },
    'notAllowedHandler' => function (ContainerInterface $container) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new NotAllowedHandler();
    },
    'errorHandler' => function (ContainerInterface $container) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new ErrorHandler();
    },
    'phpErrorHandler' => function (ContainerInterface $container) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new ErrorHandler();
    },
    /*
     |---------------------------------------------------------------------------------------------
     | Configure your dependencies over here.
     |---------------------------------------------------------------------------------------------
     |
     */
    \App\Acme\DemoClass::class => function () {
        //This is just demo dependency injection of class please remove it and define your own injection class.
        return new \App\Acme\DemoClass();
    }
];
