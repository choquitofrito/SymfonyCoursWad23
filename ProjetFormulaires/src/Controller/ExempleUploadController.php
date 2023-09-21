<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExempleUploadController extends AbstractController
{
    // afficher et traiter le formulaire d'upload d'un Livre
    #[Route('/exemple/upload')]
    public function uploadLivre(
        Request $req,
        ManagerRegistry $doctrine
    ): Response {
        $livre = new Livre();

        $formLivre = $this->createForm(LivreType::class, $livre);

        $formLivre->handleRequest($req);

        if ($formLivre->isSubmitted()) {

            $fichier = $formLivre['image']->getData();
            $dossier = $this->getParameter('kernel.project_dir') . "/public/dossierUpload";

            $nomFichier = md5(uniqid()) . "." . $fichier->guessExtension(); 
            $fichier->move ($dossier, $nomFichier);

            $livre->setLienImage ($nomFichier);
        
            // stocker le livre dans la bd
            $em = $doctrine->getManager();
            $em->persist($livre);
            $em->flush();

            // envoyer une réponse (redirect, render, Response...)
            return $this->redirectToRoute("livre_all");
        }
        // pas submit, on affiche le form
        return $this->render('exemple_upload/upload_livre.html.twig');
    }
}
