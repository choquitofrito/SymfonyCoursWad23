<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesRoutingController extends AbstractController
{

    // notre premiére action!!
    #[Route('/exemples/routing/accueil')]
    public function afficherAccueil()
    {
        // dd("Accueil heavy metal");
        // echo "<h3>Bonjour je suis le controller ExemplesRouting</h3>";
        return new Response("<h3>Bonjour je suis le controller ExemplesRouting</h3>");
    }

    // notre premiére action!!
    #[Route('/exemples/routing/adieu')]
    public function afficherAdieu()
    {
        dd("Adieu heavy metal");
    }

    // action qui reçoit de paramètres 
    #[Route('/exemples/routing/bonjour/nom/{nom}/{age}')]
    public function bonjourNom(Request $req)
    {
        // dump($req->get('nom'));
        // dd($req->get('age'));
        return new Response("<br>Bonjour " . $req->get('nom') . ", " . $req->get('age'));
    }

    // action qui reçoit un prix en paramètre et 
    // affiche le prix TVAC (utilisez une Response)
    #[Route('/exemples/routing/prix/tvac/{prix}')]
    public function afficheTva(Request $req)
    {
        return new Response("Prix: " . $req->get('prix') * 1.21);
    }

    // action qui affiche une vue
    #[Route('/exemples/routing/affiche/vue')]
    public function afficheVue()
    {
        return $this->render("/exemples_routing/affiche_vue.html.twig");
    }

    #[Route('/exemples/routing/affiche/vue2')]
    public function afficheVue2()
    {
        return $this->render("/exemples_routing/affiche_vue2.html.twig");
    }
}
