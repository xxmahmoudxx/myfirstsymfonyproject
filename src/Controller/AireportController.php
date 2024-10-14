<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AeroportRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Aeroport;
use App\Form\AeroportType;
use Doctrine\Persistence\ManagerRegistry;



class AireportController extends AbstractController
{
    #[Route('/aireport', name: 'app_aireport')]
    public function index(): Response
    {
        return $this->render('aireport/index.html.twig', [
            'controller_name' => 'AireportController',
        ]);
    }
    #[Route('/aeroports', name: '/aeroports')]
    public function getairepots(AeroportRepository $aeroportRepository): Response
    {
        $aeroports = $aeroportRepository->findAll();

        return $this->render('aireport/aerports.html.twig', [
            'aeroports' => $aeroports,
        ]);
    }

    #[Route('/aeroports/add', name: 'app_aeroport_add')]
    public function add(Request $request, AeroportRepository $aeroportRepository ,ManagerRegistry $doctrine): Response
    {
        $aeroport = new Aeroport();
        $entityManager = $doctrine->getManager();


        // Create the form using the AeroportType
        $form = $this->createForm(AeroportType::class, $aeroport);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aeroport);
        $entityManager->flush();
            return $this->redirectToRoute('/aeroports');
        }

        return $this->render('aireport/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
   
     
}


