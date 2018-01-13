<?php

namespace App\Acme\Middleware;


use Ozone\Token;

class CsrfMiddleware
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
        $route = $request->getAttribute('route');
        $basePath = $request->getUri()->getBaseUrl();

        if ($request->getMethod()=='POST' && !Token::isValid()) {
            $response->getBody()->write($this->htmlError($basePath));
        } else {
            $response = $next($request, $response);
        }

        return $response;
    }

    public function htmlError($basePath)
    {
        $html = '<html>
                        <head>
                            <title>Invalid Csrf Token</title>
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
                                <p style="color:mediumvioletred;font-size: 25px;">It seems your form has expired !</p>
                                <p class="blink"><a href="' . $basePath . '" style="color:lightseagreen;font-size:20px;text-decoration:none;">BACK TO HOME</a></p>
                            </div>
                        </body>
                    </html>';
        return $html;
    }


}