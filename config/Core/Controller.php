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
        return $this->_render($response, $template, $data);
    }

    public function display($response, $template, $data = [])
    {
        return $this->_render($response, $template, $data);
    }

    public function render($response, $template, $data = [])
    {
        return $this->_render($response, $template, $data);
    }


    public function pathFor($name,$params=[])
    {
        $router = $this->getContainer('router');
        return $router->pathFor($name,$params);
    }

    private function _render($response, $template, $data = [])
    {
        $twig = $this->getContainer(Twig::class);
        return $twig->render($response,$template,$data);
    }

    public function getContainer($name)
    {
        return $this->container->get($name);
    }

}