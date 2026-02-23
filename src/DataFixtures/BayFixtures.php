<?php

namespace App\DataFixtures;

use App\Entity\Bay;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BayFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 30; $i++) {

            $bay = new Bay();

            // B001, B002, ..., B030
            $label = 'B' . str_pad((string) $i, 3, '0', STR_PAD_LEFT);

            $bay->setLabel($label);
            $bay->setSize(42);

            $manager->persist($bay);
        }

        $manager->flush();
    }
}
