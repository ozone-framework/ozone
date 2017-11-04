<?php

namespace App\Site\Http\Controllers {

    use Slim\Views\Twig as View;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class HomeController
    {
        protected $view;

        public function __construct(View $view)
        {
            $this->view = $view;
        }

        public function index(Request $request, Response $response)
        {
            return $this->view->render($response, '@Site/home/index.twig');
        }
    }

}
