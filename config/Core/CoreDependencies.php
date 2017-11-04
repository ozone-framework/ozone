<?php

use Ozone\Token;
use Slim\Views\Twig;
use Core\TablePrefix;
use Doctrine\ORM\Events;
use Slim\Views\TwigExtension;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager;
use Slim\Flash\Messages as Flash;
use Psr\Container\ContainerInterface;
use App\Acme\Twig\TwigFilterExtension;
use App\Acme\Twig\TwigFunctionExtension;
use Doctrine\ORM\Tools\Setup as ToolSetup;

return [

    /*
     |---------------------------------------------------------------
     | Doctrine Entity Manager
     |---------------------------------------------------------------
     */
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
    /*
     |---------------------------------------------------------------
     | Twig Template Engine
     |---------------------------------------------------------------
     */
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

        //Config Views
        $view->getLoader()->addPath(ROOT . '../config/views', 'Config');

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
    /*
     |---------------------------------------------------------------
     | Flash Message
     |---------------------------------------------------------------
     */
    Flash::class => function () {
        return new Flash();
    },
    /*
     |---------------------------------------------------------------
     | Csrf Protection class
     |---------------------------------------------------------------
     */
    Token::class => function () {
        return new Token();
    }
];
