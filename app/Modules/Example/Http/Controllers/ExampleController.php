<?php

namespace App\Example\Http\Controllers {

    use App\Main\Repositories\ExampleRepository;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Views\Twig as View;

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
            echo "<pre>";
            $data = $this->example->findAll();
            dd($data);
            return $this->view->render($response, '@Example/example/index.twig');
        }
    }

}
