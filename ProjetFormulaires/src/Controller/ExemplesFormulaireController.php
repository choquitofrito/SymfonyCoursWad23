<?php
namespace App\Controller;

use App\Form\LivreType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesFormulaireController extends AbstractController {

    // Action qui AFFICHE le formulaire
    #[Route ("/exemple/form/independant")]
    public function exempleFormIndependant (){
        return $this->render ('exemples_formulaire/exemple_form_independant.html.twig');
    }

    #[Route ("/exemple/form/independant/traitement", name: "form_independant_traitement")]
    public function exempleFormIndependantTraitement(Request $req){
        // traiter le formulaire: envoyer un mail, agir sur le modèle...
        
        // si Form get, on accéde : $req->get ('nom') - pareil que pour prendre les params de l'URL

        // si Form post, accéde: $req->request->get ('nom')
        $nom = $req->request->get ('nom');
        $age = $req->request->get ('age');
        
        dump ($nom);
        dump ($age);

        dd("on traite le formulaire");
    }

    // action pour afficher le formulaire LivreType
    #[Route('/affiche/form/livre')]
    public function afficheFormLivre (){

        // créer un objet formulaire
        $formLivre = $this->createForm(LivreType::class);
        
        // envoyer le form à la vue
        $vars = ['formLivre' => $formLivre];

        return $this->render ("exemples_formulaire/affiche_form_livre.html.twig", $vars);
    }
}
