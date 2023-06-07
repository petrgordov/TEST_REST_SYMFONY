<?php

namespace App\Controller;

use \App\RestApi\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class RestApiController extends AbstractController
{

    #[Route('/rest/', name: 'rest')]
    public function index(): JsonResponse
    {
        $data = [
            'status' => 400,
            'errors' => "Please select method API",
        ];
        return $this->json($data, 400);
    }

    #[Route('/rest/{method}', name: 'app__rest_api_get', methods: 'GET')]
    public function get_method(string $method, Api $restapi): JsonResponse
    {
        return $restapi->{$method}();
    }

    #[Route('/rest/{method}/{id<\d+>}', name: 'app__rest_api_get_id', methods: 'GET',)]
    public function get_method_id(string $method, int $id, Api $restapi, Request $request): JsonResponse
    {
//        dump($em);
        return $restapi->{$method}($id,$request->query->get('taxNumber') ?? '');
    }

    #[Route('/rest/{method}', name: 'app__rest_api_post', methods: 'POST')]
    public function post_method(string $method, Api $restapi): JsonResponse
    {
        return $restapi->{$method}();
    }
}
