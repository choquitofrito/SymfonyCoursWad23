<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExercicesVueController extends AbstractController
{
    #[Route('/exercices/vue/exercice1/{prix}/{tauxTva}')]
    public function exercice1(Request $req): Response
    {
        $prix = $req->get('prix');
        $tauxTva = $req->get('tauxTva');
        $prixTotal = $prix + $prix * (1 + $tauxTva / 100);


        return $this->render(
            'exercices_vue/exercice1.html.twig',
            ['prixTotal' => $prixTotal]
        );
    }


    #[Route('/exercices/vue/exercice2/{prix}/{tauxTva}')]
    public function exercice2(Request $req): Response
    {
        $prix = $req->get('prix');
        $tauxTva = $req->get('tauxTva');
        $prixTotal = $prix + $prix * (1 + $tauxTva / 100);

        return $this->render(
            'exercices_vue/exercice2.html.twig',
            [
                'prixTotal' => $prixTotal,
                'prix' => $prix,
                'tauxTva' => $tauxTva
            ]
        );
    }

    #[Route('/exercices/vue/exercice2b/{prix}/{tauxTva}')]
    public function exercice2b(Request $req): Response
    {
        $prix = $req->get('prix');
        $tauxTva = $req->get('tauxTva');

        return $this->render(
            'exercices_vue/exercice2b.html.twig',
            [
                'prix' => $prix,
                'tauxTva' => $tauxTva
            ]
        );
    }

    #[Route('/exercices/vue/exercice3')]
    public function exercice3(): Response
    {
        return $this->render('exercices_vue/exercice3.html.twig');
    }


    // #[Route('/exercices/vue/exercice4')]
    // public function exercice4(): Response
    // {
    //     return $this->render(
    //         'exercices_vue/exercice4.html.twig',
    //         [
    //             'tabNoms' => ['Gent', 'Bruxelles', 'Dinant']
    //         ]
    //     );
    // }

    #[Route('/exercices/vue/exercice4')]
    public function exercice4(): Response
    {
        $tabNoms = ['Gent', 'Bruxelles', 'Dinant'];

        // ce qu'on envoie à la vue
        $vars = ['tabNoms' => $tabNoms,
                'salutation' => "Hi there "];

        return $this->render(
            'exercices_vue/exercice4.html.twig',
            $vars
        );
        
    }
}
