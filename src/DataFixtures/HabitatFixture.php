<?php

namespace App\DataFixtures;

use App\Entity\Habitat;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class HabitatFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $habitats = [
            ['key' => 'savane', 'nom' => 'savane', 'image' => 'savane.jpg', 'description' => 'Étendue pour lions...'],
            ['key' => 'cage_a_oiseaux', 'nom' => 'Cage à oiseaux', 'image' => 'cage_oiseau.jpg', 'description' => 'Oiseaux colorés.'],
            ['key' => 'plaine_herbivore', 'nom' => 'Plaine herbivore', 'image' => 'plaine_herbivore.jpg', 'description' => 'Pour les herbivores.'],
            ['key' => 'ecurie', 'nom' => 'Écurie', 'image' => 'ecurie.jpg', 'description' => 'Pour chevaux et lamas.'],
            ['key' => 'foret_de_singes', 'nom' => 'Forêt de singes', 'image' => 'Foret_singe.jpg', 'description' => 'Primates curieux.'],
            ['key' => 'eaux_des_crocodiles', 'nom' => 'Eaux des crocodiles', 'image' => 'eau_croco.jpg', 'description' => 'Reptiles aquatiques.'],
            ['key' => 'plaine_des_reptiles', 'nom' => 'Plaine des reptiles', 'image' => 'plaine_reptile.png', 'description' => 'Iguanes, serpents.'],
            ['key' => 'aquarium', 'nom' => 'Aquarium', 'image' => 'aquarium.jpg', 'description' => 'Espèces marines.'],
            ['key' => 'cours_d_eau_naturel', 'nom' => 'Cours d’eau naturel', 'image' => 'Cours-eau.jpg', 'description' => 'Petits mammifères.'],
        ];

        foreach ($habitats as $data) {
            $habitat = new Habitat();
            $habitat->setNom($data['nom']);
            $habitat->setImg($data['image']);
            $habitat->setDescription($data['description']);

            $manager->persist($habitat);

            $this->addReference($data['key'], $habitat); 
        }

        $manager->flush();
    }
}
