<?php

namespace App\Controller;

use App\Service\AuthorManager;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    #[Route('/', name: 'app_get_author', methods: ['GET'])]
    public function getAuthor(Request $request, AuthorManager $manager): Response
    {
        $name = $request->query->get('name');
        return new JsonResponse($manager->getAuthor($name));
    }

    #[Route('/', name: 'app_post_author', methods: ['POST'])]
    public function postAuthor(Request $request, AuthorManager $manager)
    {
        $data = json_decode($request->getContent());
        $manager->saveAuthor($data);

        return new JsonResponse([$data, true]);
    }
}
