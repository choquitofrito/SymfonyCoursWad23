<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $auteur = new Auteur (['nom' => 'Emma',
                                'nationalite' => 'Italie'];




        $manager->flush();
    }
}
