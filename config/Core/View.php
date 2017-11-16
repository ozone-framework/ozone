<?php

namespace Core;


use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

class View
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function display($response,$template,$data=[])
    {
        $twig = $this->container->get(Twig::class);
        return $twig->render($response,$template,$data);

    }

    public function render($response,$template,$data=[])
    {
        $twig = $this->container->get(Twig::class);
        return $twig->render($response,$template,$data);

    }

}