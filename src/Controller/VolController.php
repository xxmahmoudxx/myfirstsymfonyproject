<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VolRepository;
use App\Entity\Vol;
use App\Form\VolType;










class VolController extends AbstractController
{
    #[Route('/vol', name: 'app_vol')]
    public function index(): Response
    {
        return $this->render('vol/index.html.twig', [
            'controller_name' => 'VolController',
        ]);
    }






    #[Route('/vols/add', name: 'app_vol_add')]
    public function add(Request $request, VolRepository $volRepository ,ManagerRegistry $doctrine): Response
    {
        $vol = new Vol();
        $entityManager = $doctrine->getManager();

        $form = $this->createForm(VolType::class, $vol);

$        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aeroport);
            $entityManager->flush();
            return $this->redirectToRoute('app_vol'); 
        }

        return $this->render('vol/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/vols', name: '/vol')]
    public function show(VolRepository $volRepository): Response
    {
        $vols = $volRepository->findAll();

        return $this->render('vol/vols.html.twig', [
            'vols' => $vols,
        ]);
    }

}
