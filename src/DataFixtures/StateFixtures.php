<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $states = [
            'OK',
            'Incident',
            'Maintenance',
        ];

        foreach ($states as $label) {
            $state = new State();
            $state->setLabel($label);
            $manager->persist($state);
        }

        $manager->flush();
    }
}
