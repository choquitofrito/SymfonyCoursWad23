<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EffacemoiController extends AbstractController
{
    #[Route('/effacemoi', name: 'app_effacemoi')]
    public function index(): Response
    {
        return $this->render('effacemoi/index.html.twig', [
            'controller_name' => 'EffacemoiController',
        ]);
    }
}
