<?php

namespace App\Controller;

use App\Repository\RaceRepository;
use App\Repository\ClasseRepository;
use App\Repository\SurvivantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PowerController extends AbstractController
{
    #[Route('/power', name: 'app_power')]
    public function index(SurvivantRepository $repS, RaceRepository $repR, Request $request, EntityManagerInterface $entityManager): Response
    {     
        // $races = $repR->findAll();
        // $survivants= $repS->findAll(); 
        // $Selfes = $repS->power('Elfe');
        // $puissanceRace= null;
        // $race= null;
        // if(){$survivants = $repS->filter($race, $classe, $puissance);
        // }
        // foreach ($races as $r){
        //     $nom=$r->getRaceName();
        //     $puissanceRace= $repS->power($nom);
        //     echo $nom;
        //     echo $puissanceRace[1];
        // }
        $races       = $repR->findAll();
        $puissanceRace = null;
        foreach ($races as $r) {
            $name = $r->getRaceName();
            $puissanceRace[$name] = $repS->power($name)[1];
        }

return $this->render('power/power.html.twig', [
    'puissanceRace' => $puissanceRace,
]);
//         return $this->render('power/power.html.twig', [
//             'races' => $races,
//             'survivants' =>$survivants,
//             'elfes' => $Selfes,
//         ]);
    }
}
