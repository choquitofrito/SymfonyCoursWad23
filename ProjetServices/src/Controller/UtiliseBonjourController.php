<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// services propres
use App\Services\BonjourService;

class UtiliseBonjourController extends AbstractController
{
    private $bonjourService;

    public function __construct(BonjourService $bonjourService)
    {
        $this->bonjourService = $bonjourService;
    }

    #[Route('/utilise/bonjour/action1')]
    public function action1(): Response
    {
        $this->bonjourService->bonjour(); // arrete ici car il fait dd

        return $this->render('utilise_bonjour/action1.html.twig');
    }

    #[Route('/utilise/bonjour/action2')]
    public function action2(): Response
    {
        $this->bonjourService->bonjour(); // arrete ici car il fait dd

        return $this->render('utilise_bonjour/action2.html.twig');
    }
}
