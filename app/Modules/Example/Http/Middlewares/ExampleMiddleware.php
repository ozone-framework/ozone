<?php

namespace App\Modules\Example\Http\Middlewares {


    use Slim\Views\Twig;

    class ExampleMiddleware
    {
        protected $twig;

        /**
         * ExampleMiddleware constructor.
         * @param Twig $twig
         */
        public function __construct(Twig $twig)
        {
            $this->twig = $twig;
        }

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
            /*
            $route = $request->getAttribute('route');
            $param = $route->getArgument('key');
            $routeName = $route->getName();
            $groups = $route->getGroups();
            $methods = $route->getMethods();
            $arguments = $route->getArguments();
            */
            $menu = [
                'Home',
                'About Us',
                'Contact',
                'Portfolio'
            ];// Data from Database

            $this->twig->getEnvironment()->addGlobal('menus', $menu);

            $response = $next($request, $response);
            return $response;
        }

    }
}