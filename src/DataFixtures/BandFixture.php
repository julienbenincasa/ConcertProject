<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CpBand;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BandFixture extends Fixture implements DependentFixtureInterface
{
    public const DISTURBED_REFERENCE = "disturbed";

    public function load(ObjectManager $manager): void
    {
        
        $band = new CpBand();
        $band->setName("Disturbed")
            ->addMember($this->getReference(MemberFixture::DDR_REFERENCE))
            ->addMember($this->getReference(MemberFixture::DDO_REFERENCE))
            ->addMember($this->getReference(MemberFixture::JMO_REFERENCE))
            ->addMember($this->getReference(MemberFixture::MWE_REFERENCE));
        
        $manager->persist($band);

        $manager->flush();

        $this->addReference(self::DISTURBED_REFERENCE, $band);
    }

    public function getDependencies()
    {
        return [
            MemberFixture::class,
        ];
    }
}
