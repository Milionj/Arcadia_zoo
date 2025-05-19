<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User; 
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
   private UserPasswordHasherInterface $hasher;

   public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
     {
   $users = [
        ['email' => 'admin@arcadia.fr' , 'role' => ['ROLE_ADMIN']],
        ['email' => 'vet@arcadia.fr' , 'role' => ['ROLE_VETERINAIRE']],
        ['email' => 'employe@arcadia.fr', 'role' => ['ROLE_EMPLOYE']],
    ];
    foreach ($users as $data) {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setRoles($data['role']);
        $user->setMdp($this->hasher->hashPassword($user, 'mdp1234'));
        //les users ont le meme mdp pour l'instant

        $manager->persist($user);
    }
      $manager->flush();
}
}
