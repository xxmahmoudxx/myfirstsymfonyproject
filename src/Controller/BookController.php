<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use  App\Repository\BookRepository;
use  App\Entity\Book;
use  App\Entity\Author;



class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    //get all books from data base

    #[Route('/book/all', name: 'app_book_all')]
    public function getAllBooks(BookRepository $repo ): Response
    {
        // fetch all books from database
        $books = $repo -> findAll();

        return $this->render('book/all.html.twig', [
            'books' => $books,
        ]);
    }

}
