<?php

namespace Config {

    use Acme\ErrorHandler;
    use Acme\NotAllowedHandler;
    use Acme\RuntimeErrorHandler;
    use Ozone\Token;
    use Slim\Views\Twig;
    use Acme\TablePrefix;
    use DI\Bridge\Slim\App;
    use Doctrine\ORM\Events;
    use DI\ContainerBuilder;
    use Acme\NotFoundHandler;
    use Slim\Views\TwigExtension;
    use Doctrine\ORM\EntityManager;
    use Slim\Flash\Messages as Flash;
    use Doctrine\Common\EventManager;
    use Psr\Container\ContainerInterface;
    use Doctrine\ORM\Tools\Setup as ToolSetup;
    use Dopesong\Slim\Error\Whoops;

    class Framework extends App
    {
        protected static $modulePath = ROOT . '../app/Modules/';

        protected function configureContainer(ContainerBuilder $builder)
        {
            $builder->addDefinitions($this->definitions());
        }

        public function definitions()
        {
            return [
                'settings.displayErrorDetails' => (getenv('APP_ENV', 'production') == 'development') ? true : false,
                'settings.debug' => getenv('APP_DEBUG', false),
                Twig::class => function (ContainerInterface $container) {
                    $view = new Twig([],
                        [
                            'cache' => ROOT . '../storage/cache/template',//ROOT . 'storage/Cache/twig'
                            'debug' => (getenv('APP_ENV', false) == 'development') ? true : false,
                        ]);

                    //Load View Module Wise
                    $_directories = glob(self::$modulePath . "*");

                    foreach ($_directories as $dir) {

                        $_viewPath = $dir . '/Views/';
                        if (is_dir($_viewPath)) {
                            $view->getLoader()->addPath($_viewPath, str_replace(self::$modulePath, '', $dir));
                        }
                        // Module Path
                        $moduleDirs[] = $dir;
                    }

                    //Load View Module Wise End

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
                }
            ];
        }
    }
}
