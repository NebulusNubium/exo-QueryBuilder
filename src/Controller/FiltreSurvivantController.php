<?php

namespace App\Controller;

use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Survivant;
use App\Form\ClassFormType;
use App\Form\RaceFormType;
use App\Repository\RaceRepository;
use App\Repository\ClasseRepository;
use App\Repository\SurvivantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FiltreSurvivantController extends AbstractController
{
    #[Route('/filtre/survivant', name: 'app_filtre_survivant')]
    public function index(SurvivantRepository $repS, ClasseRepository $repC, RaceRepository $repR, Request $request, EntityManagerInterface $entityManager): Response
    {

        $races = $repR->findAll();
        $classes = $repC->findAll();
        $survivants= $repS->findAll();
        $race = $request->get('race');
        $puissance = $request->get('puissance');
        $classe = $request->get('class');
        if(isset($race) && isset($classe) && isset($puissance)){
            $survivants = $repS->filter($race, $classe, $puissance);
        }else{
            $survivants = $repS->findAll();
            
       }
        return $this->render('filtre_survivant/filtreSurvivant.html.twig', [
            'races' => $races,
            'classes' =>$classes,
            'survivants' =>$survivants,
        ]);
    }
}