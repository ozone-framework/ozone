<?php

namespace Core {

    use DI\Bridge\Slim\App;
    use DI\ContainerBuilder;

    class Ozone extends App
    {
        /**
         * @param ContainerBuilder $builder
         */
        protected function configureContainer(ContainerBuilder $builder)
        {
            $coreDefinitions = require ROOT . '../config/Core/CoreDependencies.php';
            $userDefinitions = require ROOT . '../config/dependencies.php';

            $builder->addDefinitions(array_merge($coreDefinitions,$userDefinitions));
            $builder->useAnnotations(true);
        }

    }
}
