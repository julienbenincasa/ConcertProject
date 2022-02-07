<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CpConcert;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ConcertFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $concert = new CpConcert();
        $concert->setBand($this->getReference(BandFixture::DISTURBED_REFERENCE))
            ->setBooker($this->getReference(BookerFixture::BKR_REFERENCE))
            ->setHall($this->getReference(HallFixture::HALL2_REFERENCE))
            ->setDate(new \DateTime("22-01-2022"));
        
        
        $manager->persist($concert);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BandFixture::class,
            HallFixture::class,
            BookerFixture::class
        ];
    }
}
