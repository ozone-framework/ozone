<?php

namespace Acme\Middleware;


class Auth
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param  callable $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route');
//        $param = $route->getArgument('key');
//        $routeName = $route->getName();
//        $groups = $route->getGroups();
//        $methods = $route->getMethods();
//        $arguments = $route->getArguments();
//        $this->get('view')->getEnvironment()->addGlobal('metadata', $metadata);

        $response = $next($request, $response);

        return $response;
    }
}