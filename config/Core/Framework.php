<?php

namespace Core {

    use DI\Bridge\Slim\App;
    use DI\ContainerBuilder;

    class Framework extends App
    {
        /**
         * @param ContainerBuilder $builder
         */
        protected function configureContainer(ContainerBuilder $builder)
        {
            $builder->addDefinitions(require ROOT . '../config/dependency-definitions.php');
        }

    }
}
