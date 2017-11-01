<?php
use Ozone\Token;
use Slim\Views\Twig;
use Core\TablePrefix;
use Core\ErrorHandler;
use Doctrine\ORM\Events;
use Core\NotFoundHandler;
use Core\NotAllowedHandler;
use Slim\Views\TwigExtension;
use Core\RuntimeErrorHandler;
use Dopesong\Slim\Error\Whoops;
use Doctrine\ORM\EntityManager;
use Slim\Flash\Messages as Flash;
use Doctrine\Common\EventManager;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\Tools\Setup as ToolSetup;

return [
    'settings.displayErrorDetails' => (getenv('APP_ENV', 'production') == 'development') ? true : false,
    'settings.debug' => getenv('APP_DEBUG', false),
    'notFoundHandler' => function (ContainerInterface $c) {
        return new NotFoundHandler();
    },
    'notAllowedHandler' => function (ContainerInterface $c) {
        return new NotAllowedHandler();
    },
    'errorHandler' => function (ContainerInterface $c) {
        return new ErrorHandler();
    },
    'phpErrorHandler' => function (ContainerInterface $c) {
        if ((getenv('APP_ENV', false) == 'development') ? true : false) {
            return new Whoops();
        }
        return new RuntimeErrorHandler();
    },
    Twig::class => function (ContainerInterface $container) {
        $view = new Twig([],
            [
                'cache' => ROOT . '../storage/cache/template',//ROOT . 'storage/Cache/twig'
                'debug' => (getenv('APP_ENV', false) == 'development') ? true : false,
            ]);

        $_directories = glob(self::$modulePath . "*");

        foreach ($_directories as $dir) {

            $_viewPath = $dir . '/Views/';
            if (is_dir($_viewPath)) {
                $view->getLoader()->addPath($_viewPath, str_replace(self::$modulePath, '', $dir));
            }
            // Module Path
            $moduleDirs[] = $dir;
        }

        $view->addExtension(new TwigExtension(
            $container->get('router'),
            $container->get('request')->getUri()
        ));

        return $view;
    },
    EntityManager::class => function () {

        $evm = new EventManager();

        $settings = include ROOT . '../config/settings.php';

        $config = ToolSetup::createAnnotationMetadataConfiguration(
            $settings['doctrine']['meta']['entity_path'],
            $settings['doctrine']['meta']['auto_generate_proxies'],
            $settings['doctrine']['meta']['proxy_dir'],
            $settings['doctrine']['meta']['cache'],
            false
        );
        //Table Prefix Event Listner
        $tablePrefix = new TablePrefix(getenv('DB_PREFIX', ''));
        $evm->addEventListener(Events::loadClassMetadata, $tablePrefix);

        return EntityManager::create($settings['doctrine']['connection'], $config, $evm);
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
    \Acme\DemoClass::class => function () {
        //This is just demo dependency injection of class please remove it and define your own injection class.
        return new \Acme\DemoClass();
    },

];