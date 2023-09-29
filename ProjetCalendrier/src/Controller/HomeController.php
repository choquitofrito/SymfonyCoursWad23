<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // s'il y a un User connecté, on charge l'accueil
        if ($this->getUser()){
            return $this->render('home/index.html.twig');
        }
        else {
            return $this->redirectToRoute("app_login");
        }
    }
}
