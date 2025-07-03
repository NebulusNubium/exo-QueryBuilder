<?php

namespace App\Controller;

use App\Repository\SurvivantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(SurvivantRepository $repository, Request $request): Response
    {
        //recuperation de la requête GET qu'on stocke dans $filter
        $filter = $request->get('filter','all');
        $puissance = $request->get('puissance', 'all');
        $classe = $request->get('classe', 'all');
        if($filter == 'asc'){
            $survivants = $repository->orderReverse();
            dump($filter);
        }elseif($filter == 'nain'){
            $survivants = $repository->nain($filter);
            dump($filter);
        }elseif($filter == 'elfe' && $puissance >= 25){
            $survivants = $repository->elf($filter, $puissance);
            dump($filter);
        }elseif($filter == 'humain' && $classe == 'archer'){
            $survivants = $repository->nonHumain($filter, $classe);
            dump($filter);
        }
        else{
            $survivants = $repository->findAll();
            dump($filter);
       }
        return $this->render('home/index.html.twig', [
            'survivants' => $survivants,
        ]);
    }
}
