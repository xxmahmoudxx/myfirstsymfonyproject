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
    private $dateDeDepart;

    #[ORM\Column(type: 'datetime')]
    private $dateDArrivee;

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

    public function getDateDeDepart(): ?\DateTimeInterface
    {
        return $this->dateDeDepart;
    }

    public function setDateDeDépart(\DateTimeInterface $dateDeDépart): self
    {
        $this->dateDeDepart = $dateDeDépart;

        return $this;
    }

    public function getDateDArrivee(): ?\DateTimeInterface
    {
        return $this->dateDArrivee;
    }

    public function setDateDArrivée(\DateTimeInterface $dateDArrivee): self
    {
        $this->dateDArrivee = $dateDArrivee;

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
