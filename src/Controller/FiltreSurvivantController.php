<?php

namespace App\Controller;


use App\Repository\SurvivantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FiltreSurvivantController extends AbstractController
{
    #[Route('/filtre/survivant', name: 'app_filtre_survivant')]
    public function index(SurvivantRepository $repository, Request $request): Response
    {
       
        $survivants = $repository->findAll();
       
        return $this->render('filtre_survivant/filtreSurvivant.html.twig', [
            'survivants' => $survivants,
        ]);
    }
}
