<?php

namespace App\DataFixtures;

use Faker;
use DateTime;
use App\Entity\User;


use App\Entity\Evenement;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');


        // obtenir la liste d'Users pour pouvoir affecter un user random à l'Evenement
        $rep = $manager->getRepository(User::class);
        $users = $rep->findAll();

        for ($i = 1; $i < 100; $i++) {
            $evenement = new Evenement();
            // $evenement->setStart(new DateTime());
            $evenement->setStart(new DateTime("2022-03-" . (($i + rand(1, 5)) % 28))); // de dates pour mars 2022
            // $evenement->setEnd(new DateTime());
            $evenement->setTitle($faker->word);
            $evenement->setDescription($faker->word . " " . $faker->word . " " . $faker->word);
            $arrAllDay = [true,false];
            // $evenement->setAllDay($arrAllDay[rand(0,1)]);
            $colors = ["#FFAABB","#EEFFAA","BBAA33"];
            $evenement->setBackgroundColor($colors [rand(0,2)]);
            // $evenement->setTextColor($colors [rand(0,2)]);
            // $evenement->setBorderColor($colors [rand(0,2)]);

            // fixer l'utilisateur, car il ne peut pas être null
            $evenement->setUser($users[array_rand($users)]);

            $manager->persist($evenement);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
         return ([
            UserFixtures::class
         ]);
    }

}

