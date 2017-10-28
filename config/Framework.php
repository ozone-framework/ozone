<?php

namespace Config {

    use Ozone\Token;
    use Slim\Views\Twig;
    use Acme\TablePrefix;
    use DI\Bridge\Slim\App;
    use DI\ContainerBuilder;
    use Doctrine\ORM\Events;
    use Slim\Views\TwigExtension;
    use Doctrine\ORM\EntityManager;
    use Doctrine\Common\EventManager;
    use Slim\Flash\Messages as Flash;
    use Psr\Container\ContainerInterface;
    use Doctrine\ORM\Tools\Setup as ToolSetup;

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
                'settings.displayErrorDetails' => (getenv('APP_ENV') == 'development') ? true : false,
                Twig::class => function (ContainerInterface $container) {
                    $view = new Twig([],
                        [
                            'cache' => ROOT . '../storage/cache/template',//ROOT . 'storage/Cache/twig'
                            'debug' => true,
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
                }
            ];
        }
    }
}
