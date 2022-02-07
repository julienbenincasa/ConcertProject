<?php

namespace App\Entity;

use App\Repository\CpConcertRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CpConcertRepository::class)
 */
class CpConcert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CpBand::class, inversedBy="concerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $band;

    /**
     * @ORM\ManyToOne(targetEntity=CpBooker::class, inversedBy="concerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booker;

    /**
     * @ORM\ManyToOne(targetEntity=CpHall::class, inversedBy="concerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hall;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBand(): ?CpBand
    {
        return $this->band;
    }

    public function setBand(?CpBand $band): self
    {
        $this->band = $band;

        return $this;
    }

    public function getBooker(): ?CpBooker
    {
        return $this->booker;
    }

    public function setBooker(?CpBooker $booker): self
    {
        $this->booker = $booker;

        return $this;
    }

    public function getHall(): ?CpHall
    {
        return $this->hall;
    }

    public function setHall(?CpHall $hall): self
    {
        $this->hall = $hall;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
