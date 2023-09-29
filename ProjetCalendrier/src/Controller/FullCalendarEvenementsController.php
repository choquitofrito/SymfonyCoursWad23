<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class FullCalendarEvenementsController extends AbstractController
{
    #[Route('/afficher/calendrier', name:'afficher_calendrier')]
    public function afficherCalendrierUser (SerializerInterface $serializer): Response
    {
        // obtenir tous les Evenements pour l'User qui est connecté
        $user = $this->getUser();
        
        $evenements = $user->getEvenements();
        // foreach ($evenements as $evenement){
            // dump ($evenement);
        // }
        $evenementsJson = $serializer->serialize
        ($evenements,'json', [AbstractNormalizer::IGNORED_ATTRIBUTES=>['user']]);

        dd($evenementsJson);




        return $this->render('full_calendar_evenements/afficher_calendrier_user.html.twig');
    }
}
