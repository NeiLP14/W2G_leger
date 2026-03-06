<?php

namespace App\DataFixtures;

use App\Entity\TypeIntervention;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeInterventionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            ['label' => 'Incident', 'color' => '#dc3545'],
            ['label' => 'Maintenance', 'color' => '#fd7e14'],
        ];

        foreach ($types as $data) {
            $type = new TypeIntervention();
            $type->setLabel($data['label']);
            $type->setColor($data['color']);

            $manager->persist($type);
        }

        $manager->flush();
    }
}
