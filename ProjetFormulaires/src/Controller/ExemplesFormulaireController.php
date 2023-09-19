<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Form\AuteurType;
use App\Form\LivreAuteurType;
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

    // afficher et traiter le formulaire pour insérer un Livre
    #[Route('/livre/add')]
    public function livreAdd(Request $req, ManagerRegistry $doctrine)
    {
        // créer une entité vide
        $livre = new Livre();
        
        // créer un objet formulaire et associer l'entité à cet bojet formulaire
        $formLivre = $this->createForm(LivreType::class, $livre);

        // traiter la requête. Si on a fait un submit, l'entité $livre sera remplie
        // avec les données du form
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

    // #[Route('/livre/fiche/{id}', name:'livre_fiche')]
    // public function livreFiche (Request $req, ManagerRegistry $doctrine){
    //     $id = $req->get('id');

    //     $em = $doctrine->getManager();
    //     $rep = $em->getRepository(Livre::class);
        
    //     $livre = $rep->find($id);
    //     dd($livre);

    // }

    // Grace à ParamConverter
    
    // afficher détail d'un Livre
    #[Route('/livre/fiche/{id}', name:'livre_fiche')]
    public function livreFiche (Livre $livre){
        
        $vars = ['livre' => $livre];
        return $this->render ('exemples_formulaire/livre_fiche.html.twig', $vars);
    }

    // delete Livre
    #[Route('/livre/delete/{id}', name:'livre_delete')]
    public function livreDelete (Livre $livre, ManagerRegistry $doctrine){
        
        $em = $doctrine->getManager();
        
        $em->remove($livre);
        $em->flush();

        return $this->redirectToRoute ('livre_all');
    }


    #[Route('/livre/update/{id}', name:'livre_update')]
    public function livreUpdate(Livre $livre, Request $req, ManagerRegistry $doctrine)
    {

        // créer un objet formulaire
        // $livre = new Livre(); // plus besoin, on reçoit le id pour le Livre et ParamConverter crée le Livre
        
        // cette fois le form va être rempli
        $formLivre = $this->createForm(LivreType::class, $livre);
        $formLivre->handleRequest($req);

        if ($formLivre->isSubmitted()) {
            $em = $doctrine->getManager();
            // $em->persist($livre); // pas besoin si on prend l'objet de la BD
            $em->flush();
            return $this->redirectToRoute("livre_all");

        }
        $vars = ['formLivre' => $formLivre];
        return $this->render("exemples_formulaire/livre_update.html.twig", $vars);
    }


}
