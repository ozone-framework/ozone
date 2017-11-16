<?php

namespace App\Modules\Example\Http\Controllers {

    use Ozone\Validate;
    use Core\View as View;
    use Psr\Http\Message\ResponseInterface as Response;
    use App\Modules\Example\Repositories\ExampleRepository;
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
            return $this->view->display($response, '@Example/example/index.twig');
        }

        public function validate(Request $request, Response $response)
        {
            $input =$request->getParsedBody();
            $files = $request->getUploadedFiles();

            $data = [];

            if ($request->getMethod() == 'POST') {
                Validate::str($input['name'], 'Name', 'required|min:3|max:4');
                Validate::email($input['email'], 'Email', 'required');

                if (Validate::isFine()) {
                    dd(dd($input));
                }
            }
            return $this->view->display($response, '@Example/example/validate.twig',$data);
        }
    }

}
