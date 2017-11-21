<?php

namespace Core;


use Slim\Views\Twig;
use DI\Annotation\Inject;
use Psr\Container\ContainerInterface;

abstract class Controller
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    private $container;

    public function view($response, $template, $data = [])
    {
        $twig = $this->container->get(Twig::class);
        return $twig->render($response,$template,$data);
    }

    public function display($response, $template, $data = [])
    {
        $twig = $this->container->get(Twig::class);
        return $twig->render($response,$template,$data);
    }

    public function render($response, $template, $data = [])
    {
        $twig = $this->container->get(Twig::class);
        return $twig->render($response,$template,$data);
    }


    public function pathFor($name,$params=[])
    {
        $router = $this->container->get('router');
        return $router->pathFor($name,$params);
    }

    public function getContainer($name)
    {
        return $this->container->get($name);
    }

}