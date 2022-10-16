<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;

class AuthorManager
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    public function getAuthor(?string $name)
    {
        $authors = $this->doctrine->getRepository(Author::class)->getAuthor($name);

        $data = [];
        foreach ($authors as $author) {
            $data[] = [
                'firstName' => $author->getFirstName(),
                'lastName' => $author->getLastName(),
                'nbBooks' => count($author->getBooks()),
                'books' => $this->getAuthorBooks($author)
            ];
        }

        return $data;
    }

    public function getAuthorBooks(Author $author)
    {
        $data = [];
        foreach ($author->getBooks() as $book) {
            $data[] = [
                $book->getTitle()
            ];
        }

        return $data;
    }

    public function saveAuthor(array $authors)
    {
        foreach ($authors as $author) {
            $newAuthor = new Author();
            $newAuthor->setFirstName($author->firstName);
            $newAuthor->setLastName($author->lastName);

            $this->doctrine->getManager()->persist($newAuthor);

            foreach ($author->books as $book) {
                $newBook = new Book();
                $newBook->setAuthor($newAuthor);
                $newBook->setResume($book->resume);
                $newBook->setTitle($book->title);

                $this->doctrine->getManager()->persist($newBook);
            }

            $this->doctrine->getManager()->flush();
        }
    }
}
