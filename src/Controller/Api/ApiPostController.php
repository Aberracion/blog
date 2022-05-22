<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\AuthorService;
use App\Service\PostService;
/**
 * @Route("/api", name="api")
 */
class ApiPostController extends AbstractController
{

    #[Route('/post/{id}', name: 'api_get_post', methods: ['GET'])]
    public function index($id, PostService $post): JsonResponse
    {
      try{
        $result = $post->get($id);
        return new JsonResponse([
          'body' => $result->getBody(),
          'subject' => $result->getSubject(),
          'author_name' => $result->getAuthor()->getName()
        ], Response::HTTP_OK);
        } catch(Exception $exc){
          return new JsonResponse(['error' => $exc->getMessage()], Response::HTTP_ERROR);
        }
    }

    #[Route('/post', name: 'api_add_post', methods: ['POST'])]
    public function post(Request $request, PostService $post): JsonResponse
    {
        try{
          $data = json_decode($request->getContent(), true);
          $post->add($data);
          return new JsonResponse(['success' => true], Response::HTTP_CREATED);
        } catch(Exception $exc){
          return new JsonResponse(['error' => $exc->getMessage()], Response::HTTP_ERROR);
        }
    }
}
