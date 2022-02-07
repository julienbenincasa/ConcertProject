<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CpMember;

class MemberFixture extends Fixture
{
    public const DDR_REFERENCE = 'david-draiman';
    public const DDO_REFERENCE = 'dan-donegan';
    public const JMO_REFERENCE = 'john-moyer';
    public const MWE_REFERENCE = 'mike-wengren';

    public function load(ObjectManager $manager): void
    {
        $ddr = new CpMember();
        $ddr->setFirstName("David")
            ->setLastName("Draiman")
            ->setBirthDate(new \DateTime("13-03-1973"))
            ->setPhoto("daviddraiman.jpg");

        $ddo = new CpMember();
        $ddo->setFirstName("Dan")
            ->setLastName("Donegan")
            ->setBirthDate(new \DateTime("01-08-1968"))
            ->setPhoto("dandonegan.jpg");

        $jmo = new CpMember();
        $jmo->setFirstName("John")
            ->setLastName("Moyer")
            ->setBirthDate(new \DateTime("30-10-1973"))
            ->setPhoto("johnmoyer.jpg");

        $mwe = new CpMember();
        $mwe->setFirstName("Mike")
            ->setLastName("Wengren")
            ->setBirthDate(new \DateTime("03-09-1971"))
            ->setPhoto("mikewengren.jpg");

        $manager->persist($ddr);
        $manager->persist($ddo);
        $manager->persist($jmo);
        $manager->persist($mwe);

        $manager->flush();

        $this->addReference(self::DDR_REFERENCE, $ddr);
        $this->addReference(self::DDO_REFERENCE, $ddo);
        $this->addReference(self::JMO_REFERENCE, $jmo);
        $this->addReference(self::MWE_REFERENCE, $mwe);
    }
}
