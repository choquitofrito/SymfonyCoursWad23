<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        // users ROLE_USER
        for ($i = 0; $i < 5; $i++) {
            $user = new User([
                'email' => 'user' .  $i . '@gmail.com',
                'roles' => [],
                'nom' => 'user' . $i,
            ]);
            // fixer un password sans hasher
            $passwordSansHash = "monpassword" . $i;
            // obtenir le password hashé
            $passwordHash = $this->passwordHasher->hashPassword(
                $user,
                $passwordSansHash
            );
            // incruster dans l'entité le password hashé
            $user->setPassword($passwordHash);
            $manager->persist($user);
        }
        $manager->flush();

        // users ROLE_CHEF et ROLE_ADMIN
        for ($i = 0; $i < 5; $i++) {
            $user = new User([
                'email' => 'userchef' .  $i . '@gmail.com',
                'roles' => ['ROLE_CHEF','ROLE_ADMIN'],
                'nom' => 'user' . $i,
            ]);
            // fixer un password sans hasher
            $passwordSansHash = "monpassword" . $i;
            // obtenir le password hashé
            $passwordHash = $this->passwordHasher->hashPassword(
                $user,
                $passwordSansHash
            );
            // incruster dans l'entité le password hashé
            $user->setPassword($passwordHash);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
