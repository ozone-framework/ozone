<?php

use Ozone\Token;
use Slim\Views\Twig;
use Core\TablePrefix;
use Core\ErrorHandler;
use Doctrine\ORM\Events;
use Core\NotFoundHandler;
use Core\NotAllowedHandler;
use Slim\Views\TwigExtension;
use Doctrine\ORM\EntityManager;
use Dopesong\Slim\Error\Whoops;
use Doctrine\Common\EventManager;
use Slim\Flash\Messages as Flash;
use App\Acme\Twig\TwigFilterExtension;
use App\Acme\Twig\TwigFunctionExtension;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\Tools\Setup as ToolSetup;

return [
    'settings.displayErrorDetails' => (getenv('APP_ENV', 'production') == 'development') ? true : false,
    'settings.debug' => getenv('APP_DEBUG', false),
    'notFoundHandler' => function (ContainerInterface $c) {
        return new NotFoundHandler();
    },
    'notAllowedHandler' => function (ContainerInterface $c) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new NotAllowedHandler();
    },
    'errorHandler' => function (ContainerInterface $c) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new ErrorHandler();
    },
    'phpErrorHandler' => function (ContainerInterface $c) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new ErrorHandler();
    },
    Twig::class => function (ContainerInterface $container) {
        $modulePath = ROOT . '../app/Modules/';
        $view = new Twig([],
            [
                'cache' => ROOT . '../storage/cache/template',//ROOT . 'storage/Cache/twig'
                'debug' => (getenv('APP_ENV', false) == 'development') ? true : false,
            ]);

        $_directories = glob($modulePath . "*");

        foreach ($_directories as $dir) {

            $_viewPath = $dir . '/Views/';
            if (is_dir($_viewPath)) {
                $view->getLoader()->addPath($_viewPath, str_replace($modulePath, '', $dir));
            }
            // Module Path
            $moduleDirs[] = $dir;
        }

        $view->addExtension(new TwigExtension(
            $container->get('router'),
            $container->get('request')->getUri()
        ));

        //FILTER
        $view->getEnvironment()->addExtension(new TwigFilterExtension());

        //FUNCTION
        $view->getEnvironment()->addExtension(new TwigFunctionExtension());

        return $view;
    },
    EntityManager::class => function () {

        $evm = new EventManager();

        $settings = include ROOT . '../config/settings.php';

        $config = ToolSetup::createAnnotationMetadataConfiguration(
            $settings['database']['meta']['entity_path'],
            $settings['database']['meta']['auto_generate_proxies'],
            $settings['database']['meta']['proxy_dir'],
            $settings['database']['meta']['cache'],
            false
        );
        //Table Prefix Event Listner
        $tablePrefix = new TablePrefix(getenv('DB_PREFIX', ''));
        $evm->addEventListener(Events::loadClassMetadata, $tablePrefix);

        return EntityManager::create($settings['database']['connection'], $config, $evm);
    },
    Flash::class => function () {
        return new Flash();
    },
    Token::class => function () {
        return new Token();
    },
    /*
     |---------------------------------------------------------------------------------------------
     | Configure your dependencies over here as defined above.
     |---------------------------------------------------------------------------------------------
     |
     */
    \App\Acme\DemoClass::class => function () {
        //This is just demo dependency injection of class please remove it and define your own injection class.
        return new \App\Acme\DemoClass();
    }
];