<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamplesDqlController extends AbstractController {

    #[Route('/dql/exemple1')]
    public function dqlExemple1 (){
        dd("Bonjour les wads!!");

    }

}