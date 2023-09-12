<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AutreExempleRoutingController extends AbstractController{

    #[Route ("/autre/exemple/routing/accueil")]
    public function accueil(){
        dd("autre exemple controller");
    }

}

