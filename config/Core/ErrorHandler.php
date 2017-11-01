<?php

namespace Core {

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class ErrorHandler
    {
        public function __invoke(Request $request, Response $response)
        {
            $basePath = $request->getUri()->getBaseUrl();
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'text/html')
                ->write($this->html($basePath));
        }

        public function html($basePath)
        {
            $html = '<html>
                        <head>
                            <title>Error</title>
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
                            .five{
                                color:darkgray;
                                font-size: 260px;
                            }
                            .info{
                              color:darkseagreen;
                              font-size: 60px;
                            }
                            .contact{
                              color:dimgrey;
                              font-size: 30px;
                            }
                            .back_link{
                                color:lightseagreen;
                                font-size:20px;
                                text-decoration:none;
                            }
                            </style>
                        </head>
                        <body style="text-align: center;">
                            <div>
                                <p>
                                    <span class="five">500</span>
                                    <span class="info">Sorry for inconvinience.</span>
                                </p>
                                <p><span class="contact">Please contact our web Admin  </span><span class="blink">Email:: ' . getenv('TECH_EMAIL') . '</span></p>
                                <p><a href="' . $basePath . '" class="back_link">BACK TO HOME</a></p>
                            </div>
                        </body>
                    </html>';
            return $html;
        }

    }
}