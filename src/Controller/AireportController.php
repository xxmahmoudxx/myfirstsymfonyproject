<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AeroportRepository;


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
    public function add(Request $request, AeroportRepository $aeroportRepository): Response
    {
        $aeroport = new Aeroport();

        // Create the form using the AeroportType
        $form = $this->createForm(AeroportType::class, $aeroport);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aeroportRepository->save($aeroport, true);

            return $this->redirectToRoute('/aeroports');
        }

        return $this->render('aeroport/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


