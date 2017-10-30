<?php

namespace Acme {

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
                            <title>Error Occured</title>
                        </head>
                        <body style="text-align: center;">
                            <div>
                                <p>
                                    <span style="color:darkgray;font-size: 260px;">500</span>
                                    <span style="color:darkseagreen;font-size: 60px;">Internal server Error</span>
                                </p>
                                <p style="color:dimgrey;font-size: 30px;">Oops something went wrong!</p>
                                <p><a href="' . $basePath . '" style="color:lightseagreen;font-size:20px;text-decoration:none;">BACK TO HOME</a></p>
                            </div>
                        </body>
                    </html>';
            return $html;
        }

    }
}