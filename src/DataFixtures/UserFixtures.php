<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {}

    public function load(ObjectManager $manager): void
    {
        $customer1 = new Customer();
        $customer1->setUsername('customer1');
        $customer1->setEmail('customer1@gmail.com');

        $password = $this->hasher->hashPassword($customer1, 'customer1');
        $customer1->setPassword($password);
        $customer1->setRoles(['ROLE_CUSTOMER']);

        $manager->persist($customer1);
        $manager->flush();
    }
}
