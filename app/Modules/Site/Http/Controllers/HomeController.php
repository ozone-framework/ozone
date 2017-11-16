<?php

namespace App\Modules\Site\Http\Controllers {

    use Core\View as View;
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
            return $this->view->display($response, '@Site/home/index.twig');
        }
    }

}
