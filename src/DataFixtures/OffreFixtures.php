<?php

namespace App\DataFixtures;

use App\Entity\Offre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OffreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Exemple de données à créer
        $offres = [
            ['label' => 'Base', 'nb_unit' => 1, 'price' => '100.00', 'reduction' => 0, 'archive' => FALSE],
            ['label' => 'Start-up', 'nb_unit' => 10, 'price' => '900.00', 'reduction' => 10, 'archive' => FALSE],
            ['label' => 'PME', 'nb_unit' => 21, 'price' => '1680.00', 'reduction' => 20, 'archive' => FALSE],
            ['label' => 'Entreprise', 'nb_unit' => 42, 'price' => '2940.00', 'reduction' => 30, 'archive' => FALSE],
        ];

        foreach ($offres as $data) {
            $offre = new Offre();
            $offre->setLabel($data['label']);
            $offre->setNbUnit($data['nb_unit']);
            $offre->setPrice($data['price']);
            $offre->setReduction($data['reduction']);
            $offre->setArchive($data['archive']);
            $manager->persist($offre);

        }

        $manager->flush();
    }
}
