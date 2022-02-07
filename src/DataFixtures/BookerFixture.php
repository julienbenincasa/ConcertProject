<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CpBooker;

class BookerFixture extends Fixture
{
    public const BKR_REFERENCE = "booker";

    public function load(ObjectManager $manager): void
    {
        $bkr = new CpBooker();
        $bkr->setFirstName("Judge")
            ->setLastName("Germa");
        
        $manager->persist($bkr);

        $manager->flush();

        $this->addReference(self::BKR_REFERENCE, $bkr);
    }
}
