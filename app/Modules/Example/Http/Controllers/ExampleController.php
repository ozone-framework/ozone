<?php

namespace App\Modules\Example\Http\Controllers {

    use Ozone\Validate;
    use Core\Controller;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\Modules\Example\Repositories\ExampleRepository;

    class ExampleController extends Controller
    {
        protected $example;

        public function __construct(ExampleRepository $exampleRepository)
        {
            $this->example = $exampleRepository;
        }

        public function index(Request $request, Response $response)
        {
            return $this->view($response, '@Example/example/index.twig');
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
                    return $response->withRedirect($this->pathFor('home'));
                }
            }

            return $this->view($response, '@Example/example/validate.twig',$data);

        }
    }

}
