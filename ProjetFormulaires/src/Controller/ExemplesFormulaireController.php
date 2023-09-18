<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Form\AuteurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesFormulaireController extends AbstractController
{

    // Action qui AFFICHE le formulaire
    #[Route("/exemple/form/independant")]
    public function exempleFormIndependant()
    {
        return $this->render('exemples_formulaire/exemple_form_independant.html.twig');
    }

    #[Route("/exemple/form/independant/traitement", name: "form_independant_traitement")]
    public function exempleFormIndependantTraitement(Request $req)
    {
        // traiter le formulaire: envoyer un mail, agir sur le modèle...

        // si Form get, on accéde : $req->get ('nom') - pareil que pour prendre les params de l'URL

        // si Form post, accéde: $req->request->get ('nom')
        $nom = $req->request->get('nom');
        $age = $req->request->get('age');

        dump($nom);
        dump($age);

        dd("on traite le formulaire");
    }

    // action pour afficher le formulaire LivreType
    // #[Route('/affiche/form/livre')]
    // public function afficheFormLivre (){

    //     // créer un objet formulaire
    //     $formLivre = $this->createForm(LivreType::class);

    //     // envoyer le form à la vue
    //     $vars = ['formLivre' => $formLivre];

    //     return $this->render ("exemples_formulaire/affiche_form_livre.html.twig", $vars);
    // }

    #[Route('/affiche/form/auteur')]
    public function afficherFormAuteur()
    {
        $formAuteur = $this->createForm(AuteurType::class);

        $vars = ['formAuteur' => $formAuteur];

        return $this->render("exemples_formulaire/affiche_form_auteur.html.twig", $vars);
    }


    #[Route('/livre/add')]
    public function livreAdd(Request $req, ManagerRegistry $doctrine)
    {

        // créer un objet formulaire
        $livre = new Livre();

        $formLivre = $this->createForm(LivreType::class, $livre);

        $formLivre->handleRequest($req);

        // on vient d'un submit
        if ($formLivre->isSubmitted()) {
            // formulaire soumis, stocker dans la BD

            $em = $doctrine->getManager();
            $em->persist($livre);
            $em->flush();

            // pour éviter l'insertion si on recharge la page, on va charger une autre action
            
            // ex: aller dans la liste de Livres, aller dans le détail du Livre
            // redirectToRoute reçoit le nom d'une route
            return $this->redirectToRoute("livre_all");


            // return new Response("Livre enregistré");
            // dump ($livre);
            // dd("On a envoyé le form");

        }
        // on ne vient pas d'un submit
        // envoyer le form à la vue
        $vars = ['formLivre' => $formLivre];
        return $this->render("exemples_formulaire/livre_add.html.twig", $vars);
    }

    // afficher tous les livres
    #[Route ('/livre/all', name: 'livre_all')]
    public function livreAll (ManagerRegistry $doctrine){
        $repLivres = $doctrine->getRepository(Livre::class);
        $arrayObjetsLivres = $repLivres->findAll();

        $vars = ['arrayObjetsLivres' => $arrayObjetsLivres];

        return $this->render ('exemples_formulaire/livre_all.html.twig', $vars);
    }
}
