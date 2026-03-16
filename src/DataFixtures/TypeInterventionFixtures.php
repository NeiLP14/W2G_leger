<?php

namespace App\DataFixtures;

use App\Entity\TypeIntervention;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeInterventionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $incident = new TypeIntervention();
        $incident->setLabel("Incident");
        $incident->setColor("#dc3545");

        $maintenance = new TypeIntervention();
        $maintenance->setLabel("Maintenance");
        $maintenance->setColor("#fd7e14");

        $manager->persist($incident);
        $manager->persist($maintenance);

        $manager->flush();
    }
}