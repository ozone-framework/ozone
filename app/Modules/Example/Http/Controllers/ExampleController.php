<?php

namespace App\Example\Http\Controllers {

    use Slim\Views\Twig as View;
    use DI\Annotation\Injectable;
    use App\Example\Repositories\ExampleRepository;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class ExampleController
    {
        protected $view;
        protected $example;

        public function __construct(View $view,ExampleRepository $exampleRepository)
        {
            $this->view = $view;
            $this->example = $exampleRepository;
        }

        public function index(Request $request, Response $response)
        {
            return $this->view->render($response, '@Example/example/index.twig');
        }
    }

}
