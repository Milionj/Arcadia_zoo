<?php

namespace App\Entity;

use App\Repository\AlimentationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Animal;


#[ORM\Entity(repositoryClass: AlimentationRepository::class)]
class Alimentation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $nourriture = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_alimentation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getNourriture(): ?string
    {
        return $this->nourriture;
    }

    public function setNourriture(string $nourriture): static
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    public function getDateAlimentation(): ?\DateTimeInterface
    {
        return $this->date_alimentation;
    }

    public function setDateAlimentation(\DateTimeInterface $date_alimentation): static
    {
        $this->date_alimentation = $date_alimentation;

        return $this;
    }

    
#[ORM\ManyToOne(inversedBy: 'alimentations')]
#[ORM\JoinColumn(nullable: false)]
private ?Animal $animal = null;

public function getAnimal(): ?Animal
{
    return $this->animal;
}

public function setAnimal(?Animal $animal): static
{
    $this->animal = $animal;

    return $this;
}
}
