<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Emprunt;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

// Faker


use Faker;

class EmpruntFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create();

        $dateEmprunt = $faker->dateTime();
        $dateRetourPrevu = clone $dateEmprunt;
        $dateRetourPrevu->modify ("+25 day");
        $dateRetourReelle = clone $dateEmprunt;
        $dateRetourReelle->modify ("+" . mt_rand (1,40) . " day");
        
        $emprunt = new Emprunt([
            'dateEmprunt' => $dateEmprunt ,
            'dateRetourPrevu'=> $dateRetourPrevu,
            'dateRetourReelle'=> $dateRetourReelle
        ]);

        // obtenir un Client au hasard
        $repClient = $manager->getRepository(Client::class);
        $arrayClients = $repClient->findAll();
        $randomClient = $arrayClients [array_rand($arrayClients)];

        // obtenir un Exemplaire au hasard
        $repExemplaire = $manager->getRepository(Exemplaire::class);
        $arrayExemplaires = $repExemplaire->findAll();
        $randomExemplaire = $arrayExemplaires [array_rand($arrayExemplaires)];
        
    }
}
