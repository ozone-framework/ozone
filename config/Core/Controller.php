<?php

namespace Core;

use Slim\Views\Twig;
use DI\Annotation\Inject;
use Slim\Flash\Messages as Flash;
use Psr\Container\ContainerInterface;

abstract class Controller
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    public function view($response, $template, $data = [])
    {
        $twig = $this->getContainer(Twig::class);
        return $twig->render($response, $template, $data);
    }

    public function getContainer($name)
    {
        return $this->container->get($name);
    }

    public function pathFor($name, $params = [])
    {
        $router = $this->getContainer('router');
        return $router->pathFor($name, $params);
    }
}
