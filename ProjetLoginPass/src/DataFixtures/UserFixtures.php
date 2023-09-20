<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User([
            'email' => 'laurence@gmail.com',
            'roles' => [],
            'nom' => 'laurence',
            'password' => 'monpass'
        ]);

        $manager->persist($user);
        $manager->flush();
    }
}
