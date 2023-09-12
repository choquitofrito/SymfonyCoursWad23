<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NouveauController extends AbstractController
{
    #[Route('/nouveau')]
    public function index(): Response
    {
        return $this->render('nouveau/index.html.twig', 
        [
            'nom_controller' => 'Frites et bière',
            'hobby' => 'sortir et danser',
            'etat' => 'il fait vraiment chaud',
            'stagiaires' => ['Vitoria', 'Margot', 'Senem'],
            'produit' => [
                'nom' => 'Citron',
                'prix' => 3
            ],
            'uneVoiture' => new Voiture(),
            'dateToday' => new DateTime()

        ]);
    }
   
}
// il n'y aura jamais une classe ici
class Voiture {
    public $modele = "Porsche";
}
