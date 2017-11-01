<?php

namespace Core {

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class NotAllowedHandler
    {
        public function __invoke(Request $request, Response $response)
        {
            $basePath = $request->getUri()->getBaseUrl();
            return $response
                ->withStatus(405)
                ->withHeader('Content-Type', 'text/html')
                ->write($this->html($basePath));
        }

        public function html($basePath)
        {
            $html = '<html>
                        <head>
                            <title>Method Not Allowed</title>
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
                                    <span style="color:darkgray;font-size: 260px;">405</span>
                                    <span style="color:darkseagreen;font-size: 60px;">Method not Allowed</span>
                                </p>
                                <p style="color:dimgrey;font-size: 30px;">Current method is not allowed.</p>
                                <p class="blink"><a href="' . $basePath . '" style="color:lightseagreen;font-size:20px;text-decoration:none;">BACK TO HOME</a></p>
                            </div>
                        </body>
                    </html>';
            return $html;
        }

    }
}