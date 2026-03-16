<?php

namespace App\DataFixtures;

use App\Entity\Intervention;
use App\Entity\TypeIntervention;
use App\Entity\Unit;
use App\Entity\Technician;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InterventionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $types = $manager->getRepository(TypeIntervention::class)->findAll();
        $units = $manager->getRepository(Unit::class)->findAll();
        $technicians = $manager->getRepository(Technician::class)->findAll();

        for ($i = 0; $i < 30; $i++) {

            $intervention = new Intervention();

            $dateDeb = new \DateTime();
            $dateDeb->modify('-' . rand(1, 90) . ' days');

            $dateFin = clone $dateDeb;
            $dateFin->modify('+' . rand(1, 5) . ' hours');

            $intervention->setDateDeb($dateDeb);
            $intervention->setDateFin($dateFin);

            $intervention->setDescription(
                rand(0,1)
                ? "Incident détecté sur l'unité nécessitant une intervention technique."
                : "Maintenance préventive pour vérification des équipements."
            );

            $intervention->setTechnician(
                $technicians[array_rand($technicians)]
            );

            $intervention->setTypeIntervention(
                $types[array_rand($types)]
            );

            $nbUnits = rand(1,3);

            for ($j = 0; $j < $nbUnits; $j++) {
                $unit = $units[array_rand($units)];
                $intervention->addUnit($unit);
            }

            $manager->persist($intervention);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeInterventionFixtures::class,
            TechnicianFixtures::class
        ];
    }
}