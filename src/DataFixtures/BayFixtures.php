<?php

namespace App\DataFixtures;

use App\Entity\Bay;
use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BayFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 30; $i++) {

            $bay = new Bay();
            $label = 'B' . str_pad((string) $i, 3, '0', STR_PAD_LEFT);

            $bay->setLabel($label);
            $bay->setSize(42);

            $manager->persist($bay);

            // Génération des 42U
            for ($u = 1; $u <= 42; $u++) {

                $unit = new Unit();

                $unit->setPosition($u);
                $unit->setLabel('U' . str_pad((string) $u, 2, '0', STR_PAD_LEFT));
                $unit->setIsOccuped(false);
                $unit->setBay($bay);

                $manager->persist($unit);
            }
        }

        $manager->flush();
    }
}
