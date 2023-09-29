<?php

namespace App\Controller;

use App\Entity\RechercheLivrePrix;
use DateTime;
use App\Form\RechercheLivrePrixType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamplesDqlController extends AbstractController
{

    // DQL: obtenir tous les auteurs
    #[Route('/dql/exemple1')]
    public function dqlExemple1(ManagerRegistry $doctrine)
    {

        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT auteur FROM App\Entity\Auteur auteur");
        $res = $query->getResult();
        dd($res);
    }

    // DQL: obtenir tous les emprunts
    #[Route('/dql/exemple2')]
    public function dqlExemple2(ManagerRegistry $doctrine)
    {

        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT e FROM App\Entity\Emprunt e");
        $res = $query->getResult();
        dd($res);

        // on peut maintenant accéder aux Auteurs si on le veut
        // dd($res[0]->getClient()->getNom());

    }


    // Obtenir le nombre de livres (on obtient un array d'arrays)
    #[Route('/dql/exemple3')]
    public function dqlExemple3(ManagerRegistry $doctrine)
    {

        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT COUNT(livre) AS totalLivres FROM App\Entity\Livre livre");
        $res = $query->getResult();
        // accéder à la valeur
        $totalLivres = $res[0]['totalLivres'];
        dd($totalLivres);
    }

    // Obtenir le nombre de livres publiés entre deux dates (on obtient un array d'arrays)
    #[Route('/dql/exemple4')]
    public function dqlExemple4(ManagerRegistry $doctrine)
    {

        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT COUNT(livre) AS totalLivres 
                                FROM App\Entity\Livre livre
                                WHERE livre.datePublication > :date1 
                                AND livre.datePublication < :date2"); // on peut aussi utiliser BETWEEN
        $query->setParameter("date1", new DateTime("3/4/01"));
        $query->setParameter("date2", new DateTime("3/4/28"));

        $res = $query->getResult();
        // accéder à la valeur
        $totalLivres = $res[0]['totalLivres'];
        dd($totalLivres);
    }

    // action qui affiche et traite un formulaire de recherche de livres par prix
    #[Route('/form/dql/recherche/prix')]
    public function formDqlRecherchePrix(Request $req, ManagerRegistry $doctrine)
    {

        $rechercheLivrePrix = new RechercheLivrePrix();

        $form = $this->createForm(RechercheLivrePrixType::class, $rechercheLivrePrix);

        $form->handleRequest($req);

        // si on vient d'un submit
        if ($form->isSubmitted()) {
            // prendre les valeurs du form
            $minPrix = $rechercheLivrePrix->getMinPrix();
            $maxPrix = $rechercheLivrePrix->getMaxPrix();

            // lancer la requête
            $em = $doctrine->getManager();
            $query = $em->createQuery("SELECT livre FROM App\Entity\Livre livre WHERE livre.prix > :minPrix 
                                        AND livre.prix < :maxPrix");
            $query->setParameter("minPrix", $minPrix);
            $query->setParameter("maxPrix", $maxPrix);
            $res = $query->getResult();
            $vars = ['listeLivres' => $res];
            // dd($res); // charger la vue qui affiche le resultat
            return $this->render('/exemples_dql/form_dql_recherche_prix_resultat.html.twig', $vars);
        }

        $vars = ['formRecherchePrix' => $form];
        return $this->render('/exemples_dql/form_dql_recherche_prix.html.twig', $vars);
    }


    // obtention de tous les livres 
    // avec leurs exemplaires
    #[Route('/dql/exemple5')]
    public function dqlExemple5(ManagerRegistry $doctrine)
    {

        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT l,e FROM App\Entity\Livre l
                                    INNER JOIN l.exemplaires e"); // on peut aussi utiliser BETWEEN

        $res = $query->getResult();

        dd($res);
    }

    // obtention des titres des Livres et 
    // de l'état de chaque Livre (on aura un 
    // array d'arrays!)
    #[Route('/dql/exemple6')]
    public function dqlExemple6(ManagerRegistry $doctrine)
    {

        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT l.titre, e.etat 
                                    FROM App\Entity\Livre l
                                    INNER JOIN l.exemplaires e"); // on peut aussi utiliser BETWEEN

        $res = $query->getResult();
        dd($res);
    }


}
