<?php

namespace App\Entity;

use App\Repository\VisiteVeterinaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Animal;

#[ORM\Entity(repositoryClass: VisiteVeterinaireRepository::class)]
class VisiteVeterinaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $diagnosticAnimal = null;

    #[ORM\Column(length: 255)]
    private ?string $nourriturePropose = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $grammageNourriture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePassage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnosticAnimal(): ?string
    {
        return $this->diagnosticAnimal;
    }

    public function setDiagnosticAnimal(string $diagnosticAnimal): static
    {
        $this->diagnosticAnimal = $diagnosticAnimal;

        return $this;
    }

    public function getNourriturePropose(): ?string
    {
        return $this->nourriturePropose;
    }

    public function setNourriturePropose(string $nourriturePropose): static
    {
        $this->nourriturePropose = $nourriturePropose;

        return $this;
    }

    public function getGrammageNourriture(): ?string
    {
        return $this->grammageNourriture;
    }

    public function setGrammageNourriture(string $grammageNourriture): static
    {
        $this->grammageNourriture = $grammageNourriture;

        return $this;
    }

    public function getDatePassage(): ?\DateTimeInterface
    {
        return $this->datePassage;
    }

    public function setDatePassage(\DateTimeInterface $datePassage): static
    {
        $this->datePassage = $datePassage;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'visites')]
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
