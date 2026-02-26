<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            [
                'label' => 'Serveur Web',
                'color' => '#007bff', // bleu
            ],
            [
                'label' => 'Base de données',
                'color' => '#28a745', // vert
            ],
            [
                'label' => 'Stockage',
                'color' => '#6c757d', // gris
            ],
            [
                'label' => 'Firewall',
                'color' => '#dc3545', // rouge
            ],
            [
                'label' => 'Load Balancer',
                'color' => '#fd7e14', // orange
            ],
            [
                'label' => 'Backup',
                'color' => '#6610f2', // violet
            ],
        ];

        foreach ($types as $data) {
            $type = new Type();
            $type->setLabel($data['label']);
            $type->setColor($data['color']);

            $manager->persist($type);
        }

        $manager->flush();
    }
}
