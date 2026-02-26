<?php

namespace App\DataFixtures;

use App\Entity\Bay;
use App\Entity\State;
use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Repository\StateRepository;

class BayFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            StateFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {
        $stateRepository = $manager->getRepository(State::class);
        $defaultState = $stateRepository->findOneBy(['label' => 'OK']);

        for ($i = 1; $i <= 30; $i++) {

            $bay = new Bay();
            $label = 'B' . str_pad((string) $i, 3, '0', STR_PAD_LEFT);

            $bay->setLabel($label);
            $bay->setSize(42);

            $manager->persist($bay);

            for ($u = 1; $u <= 42; $u++) {

                $unit = new Unit();

                $unit->setPosition($u);
                $unit->setLabel('U' . str_pad((string) $u, 2, '0', STR_PAD_LEFT));
                $unit->setIsOccuped(false);
                $unit->setBay($bay);
                $unit->setState($defaultState);

                $manager->persist($unit);
            }
        }

        $manager->flush();
    }
}
