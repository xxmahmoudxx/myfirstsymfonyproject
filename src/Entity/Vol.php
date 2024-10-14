<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $villeDestination;

    #[ORM\Column(type: 'datetime')]
    private $dateDeDépart;

    #[ORM\Column(type: 'datetime')]
    private $dateDArrivée;

    #[ORM\ManyToOne(targetEntity: Aeroport::class, inversedBy: 'vols')]
    #[ORM\JoinColumn(nullable: false)]
    private $aeroport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDestination(): ?string
    {
        return $this->villeDestination;
    }

    public function setVilleDestination(string $villeDestination): self
    {
        $this->villeDestination = $villeDestination;

        return $this;
    }

    public function getDateDeDépart(): ?\DateTimeInterface
    {
        return $this->dateDeDépart;
    }

    public function setDateDeDépart(\DateTimeInterface $dateDeDépart): self
    {
        $this->dateDeDépart = $dateDeDépart;

        return $this;
    }

    public function getDateDArrivée(): ?\DateTimeInterface
    {
        return $this->dateDArrivée;
    }

    public function setDateDArrivée(\DateTimeInterface $dateDArrivée): self
    {
        $this->dateDArrivée = $dateDArrivée;

        return $this;
    }

    public function getAeroport(): ?Aeroport
    {
        return $this->aeroport;
    }

    public function setAeroport(?Aeroport $aeroport): self
    {
        $this->aeroport = $aeroport;

        return $this;
    }
}
