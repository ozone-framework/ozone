<?php

namespace Core {

    use DI\Bridge\Slim\App;
    use DI\ContainerBuilder;

    class Framework extends App
    {
        protected static $modulePath = ROOT . '../app/Modules/';

        protected function configureContainer(ContainerBuilder $builder)
        {
            $builder->addDefinitions(require ROOT . '../config/dependency-definitions.php');
        }

    }
}
