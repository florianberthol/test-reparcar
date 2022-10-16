<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BookController extends AbstractController
{
    /**
     * return all name of books in json format
     *
     */
    #[Route('/books/list', name: 'list-of-my-books', methods: ['GET'], format: 'json')]
    public function book(ManagerRegistry $doctrine, Environment $twig): Response
    {
        $book = $doctrine->getRepository(Book::class)->findOneBy(['id' => 101]);
        $template = $twig->load('book/index.html.twig');

        return new Response($template->render([
            'result' => json_encode([
                'data' => json_encode($book?->getTitle())
            ]),
        ]));
    }

    /**
     * parcour all books and add sufix on name
     */
    #[Route('/books/add-sufix/{suffix}', name: 'add-sufix-on-my-books', methods: ['PUT'], format: 'json')]
    public function addSufix(string $suffix, ManagerRegistry $doctrine, Environment $twig): Response
    {
        $books = $doctrine->getRepository(Book::class)->findBy([]);

        foreach ($books as $book) {
            $book->setTitle($book->getTitle() . ' - ' . $suffix);
            $doctrine->getManager()->persist($book);
            $doctrine->getManager()->flush();
        }


        $template = $twig->load('book/index.html.twig');

        return new Response($template->render([
            'result' => json_encode([
                'data' => json_encode('ok'),
                'books' => json_encode($books)
            ]),
        ]));
    }
}
