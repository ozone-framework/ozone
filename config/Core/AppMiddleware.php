<?php

namespace Core;


class AppMiddleware
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
        /*
        $route = $request->getAttribute('route');
        $param = $route->getArgument('key');
        $routeName = $route->getName();
        $groups = $route->getGroups();
        $methods = $route->getMethods();
        $arguments = $route->getArguments();
        $this->get('view')->getEnvironment()->addGlobal('metadata', $metadata);
        */
        $loopBck = ['localhost','127.0.0.1'];
        $currentHost = $request->getUri()->getHost();

        if (!in_array($currentHost, $loopBck) and getenv('APP_ENV') == 'development') {
            $response->getBody()->write($this->htmlError());
        } else {

            $response = $next($request, $response);
        }

        return $response;
    }

    public function checkIps()
    {

    }

    public function isMaintenanceMode()
    {

    }

    public function htmlError()
    {
        $html = '<html>
                        <head>
                            <title>Configuration Error</title>
                            <style>
                            @-webkit-keyframes blinker {
                              from {opacity: 1.0;}
                              to {opacity: 0.0;}
                            }
                            .blink{
                                text-decoration: blink;
                                -webkit-animation-name: blinker;
                                -webkit-animation-duration: 0.6s;
                                -webkit-animation-iteration-count:infinite;
                                -webkit-animation-timing-function:ease-in-out;
                                -webkit-animation-direction: alternate;
                            }
                            </style>
                        </head>
                        <body style="text-align: center;">
                            <div>
                                <p>
                                    <span style="color:darkgray;font-size: 260px;">403</span>
                                    <span style="color:darkseagreen;font-size: 60px;">Forbidden</span>
                                </p>
                                <p style="color:mediumvioletred;font-size: 25px;">Change environment variable to production. Your app seems in production level</p>
                                <p class="blink"><span style="color:lightseagreen;font-size:19px;text-decoration:none;">GOOD LUCK</span></p>
                            </div>
                        </body>
                    </html>';
        return $html;
    }

}