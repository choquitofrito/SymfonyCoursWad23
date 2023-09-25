<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamplesDqlController extends AbstractController {

    #[Route('/dql/exemple1')]
    public function dqlExemple1 (ManagerRegistry $doctrine){
        
        $em = $doctrine->getManager();
        $query = $em->createQuery ("");
        $res = $query->getResult();

        dd($res);


    }

}