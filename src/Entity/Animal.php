<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Habitat;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Alimentation;
use App\Entity\VisiteVeterinaire;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $espece = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

      public function getEspece(): ?string
    {
        return $this->espece;
    }

        public function setEspece(string $espece): static
    {
        $this->espece = $espece;

        return $this;
    }

#[ORM\ManyToOne(inversedBy: 'animaux')]
#[ORM\JoinColumn(nullable: false)]
private ?Habitat $habitat = null;

// Getter
public function getHabitat(): ?Habitat
{
    return $this->habitat;
}

// Setter
public function setHabitat(?Habitat $habitat): static
{
    $this->habitat = $habitat;

    return $this;
}

#[ORM\OneToMany(mappedBy: 'animal', targetEntity: Alimentation::class, orphanRemoval: true)]
private Collection $alimentations;

public function __construct()
{
    $this->alimentations = new ArrayCollection();
}

public function getAlimentations(): Collection
{
    return $this->alimentations;
}

public function addAlimentation(Alimentation $alimentation): static
{
    if (!$this->alimentations->contains($alimentation)) {
        $this->alimentations[] = $alimentation;
        $alimentation->setAnimal($this);
    }

    return $this;
}

public function removeAlimentation(Alimentation $alimentation): static
{
    if ($this->alimentations->removeElement($alimentation)) {
        if ($alimentation->getAnimal() === $this) {
            $alimentation->setAnimal(null);
        }
    }

    return $this;
}


#[ORM\OneToMany(mappedBy: 'animal', targetEntity: VisiteVeterinaire::class, orphanRemoval: true)]
private Collection $visites;

public function getVisites(): Collection
{
    return $this->visites;
}

public function addVisite(VisiteVeterinaire $visite): static
{
    if (!$this->visites->contains($visite)) {
        $this->visites[] = $visite;
        $visite->setAnimal($this);
    }

    return $this;
}

public function removeVisite(VisiteVeterinaire $visite): static
{
    if ($this->visites->removeElement($visite)) {
        if ($visite->getAnimal() === $this) {
            $visite->setAnimal(null);
        }
    }

    return $this;
}
}
