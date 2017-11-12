<?php

namespace App\Example\Http\Controllers {

    use Ozone\Validate;
    use Slim\Views\Twig as View;
    use App\Example\Repositories\ExampleRepository;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class ExampleController
    {
        protected $view;
        protected $example;

        public function __construct(View $view, ExampleRepository $exampleRepository)
        {
            $this->view = $view;
            $this->example = $exampleRepository;
        }

        public function index(Request $request, Response $response)
        {
            return $this->view->render($response, '@Example/example/index.twig');
        }

        public function validate(Request $request, Response $response)
        {
            $input =$request->getParsedBody();
            $files = $request->getUploadedFiles();


            $data = [];

            if ($request->getMethod() == 'POST') {
//                dd($files['image']);
                Validate::str($input['name'], 'Name', 'required|min:3|max:4');
                Validate::email($input['email'], 'Email', 'required');

                if (Validate::isFine()) {
                    dd(dd($input));
                }
            }
            return $this->view->render($response, '@Example/example/validate.twig',$data);
        }
    }

}
