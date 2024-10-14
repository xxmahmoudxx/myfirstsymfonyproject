<?php

namespace App\Controller;
use  App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Author; // Ensure this import statement is present
use App\Form\AuthorType;


class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/Author/{name}', name: 'AuthorName')] 


    public function showAuthor(string $name): Response{
        return $this->render('author/showhtml.twig', [
            'name' => $name,
        ]);

    }
    #[Route('/authors', name: 'list_authors')]
    public function listAuthors (): Response{
    $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
        array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        $totalBooks = 0;
        foreach ($authors as $author) {
            $totalBooks += $author['nb_books'];
        }
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'totalBooks' => $totalBooks,
        ]);

        

}
#[Route('/author_details/{id}', name: 'author_details')]
public function showAuthorDetails(int $id): Response {
    $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
        array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
    $author = $authors[$id];
    return $this->render('author/details.html.twig', [
        'author' => $author,
    ]);
}
#[Route('author/list' ,name:'author/list')]
public function read(AuthorRepository $repoAuthor):Response {
    $List=$repoAuthor -> findAll();
    return $this->render('author/Lista.html.twig',[
        'List' => $List
    ]);
}

#[Route('author/add', name: 'author_add')]
public function add(Request $request, ManagerRegistry $doctrine): Response 
{
    $author = new Author();
    $entityManager = $doctrine->getManager();
    $form = $this->createForm(AuthorType::class, $author);
    $form->handleRequest($request); // Process form data

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($author);
        $entityManager->flush();

        // Redirect to a different route after form submission
        return $this->redirectToRoute('author/list');
    }

    // Render the form template
    return $this->renderForm('author/add.html.twig', [
        'form' => $form,
    ]);
}

#[Route('author/delite/{id}', name: 'author/delite')]
public function delete( $id,AuthorRepository $repoAuthor, ManagerRegistry $doctrine): Response {
    $author = $repoAuthor->find($id);

    if (!$author) {
        throw $this->createNotFoundException('The author does not exist.');
    }

    $entityManager = $doctrine->getManager();
    $entityManager->remove($author);
    $entityManager->flush();

    return $this->redirectToRoute('author/list');
}


#[Route('author/edit/{id}', name: 'author_edit')]
public function edit(Request $request, Author $author, ManagerRegistry $doctrine): Response
{
    $entityManager = $doctrine->getManager();
    $form = $this->createForm(AuthorType::class, $author);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        return $this->redirectToRoute('author/list');
        }
        return $this->renderForm('author/edit.html.twig', [
            'form' => $form,
            'author' => $author,
        ]);
        }


    
   
}