<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CpHall;

class HallFixture extends Fixture
{
    public const HALL1_REFERENCE = "hall-1";
    public const HALL2_REFERENCE = "hall-2";
    public const HALL3_REFERENCE = "hall-3";

    public function load(ObjectManager $manager): void
    {
        $hall1 = new CpHall();
        $hall1->setName("Pretty Hall")
              ->setCapacity("18000")
              ->setAvailable(true);

        $hall2 = new CpHall();
        $hall2->setName("Big Hall")
              ->setCapacity("35000")
              ->setAvailable(true);
        
        $hall3 = new CpHall();
        $hall3->setName("Space Hall")
            ->setCapacity("25000")
            ->setAvailable(false);

        $manager->persist($hall1);
        $manager->persist($hall2);
        $manager->persist($hall3);

        $manager->flush();

        $this->setReference(self::HALL2_REFERENCE, $hall2);
    }
}
