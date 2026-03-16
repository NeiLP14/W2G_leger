<?php

namespace App\DataFixtures;

use App\Entity\Technician;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnicianFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {

            $tech = new Technician();

            $tech->setEmail("tech$i@w2g.com");
            $tech->setUsername("tech$i");
            $tech->setNom("Technicien$i");
            $tech->setPrenom("Test$i");
            $tech->setPassword(password_hash("password", PASSWORD_BCRYPT));

            $manager->persist($tech);
        }

        $manager->flush();
    }
}