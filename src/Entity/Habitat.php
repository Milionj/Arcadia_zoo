<?php

namespace App\Entity;

use App\Repository\HabitatRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Animal;

#[ORM\Entity(repositoryClass: HabitatRepository::class)]
class Habitat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
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
    
    #[ORM\OneToMany(mappedBy: 'habitat', targetEntity: Animal::class)]
private Collection $animaux;

public function __construct()
{
    $this->animaux = new ArrayCollection();
}

// Getter
public function getAnimaux(): Collection
{
    return $this->animaux;
}


// Ajouter un animal
public function addAnimal(Animal $animal): static
{
    if (!$this->animaux->contains($animal)) {
        $this->animaux[] = $animal;
        $animal->setHabitat($this);
    }

    return $this;
}

// Retirer un animal
public function removeAnimal(Animal $animal): static
{
    if ($this->animaux->removeElement($animal)) {
        if ($animal->getHabitat() === $this) {
            $animal->setHabitat(null);
        }
    }

    return $this;
}
}
