<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Accountant;
use App\Entity\Technician;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {

        // ADMIN
        $admin = new Admin();
        $admin->setEmail('admin@worktogether.com');
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword(
            $this->hasher->hashPassword($admin, 'admin')
        );

        $manager->persist($admin);


        // ACCOUNTANT
        $accountant = new Accountant();
        $accountant->setEmail('accountant@worktogether.com');
        $accountant->setUsername('accountant');
        $accountant->setRoles(['ROLE_ACCOUNTANT']);

        $accountant->setPassword(
            $this->hasher->hashPassword($accountant, 'accountant')
        );

        $manager->persist($accountant);


        // TECHNICIAN
        $technician = new Technician();
        $technician->setEmail('tech@worktogether.com');
        $technician->setUsername('technician');
        $technician->setRoles(['ROLE_TECHNICIAN']);

        $technician->setPassword(
            $this->hasher->hashPassword($technician, 'technician')
        );

        $manager->persist($technician);


        $manager->flush();
    }
}