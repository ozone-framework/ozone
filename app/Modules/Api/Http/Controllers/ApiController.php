<?php

namespace App\Modules\Api\Http\Controllers {

    use Core\Controller;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class ApiController extends Controller
    {
        /**
         * @param Request $request
         * @param Response $response
         * @return mixed
         */
        public function index(Request $request, Response $response)
        {
            $data['data'] = [
                'title'=>"Ozone",
                "detail"=>"Php Modular framework"
            ];
            return $response->withJSON($data,200,JSON_PRETTY_PRINT);
        }
    }
}
