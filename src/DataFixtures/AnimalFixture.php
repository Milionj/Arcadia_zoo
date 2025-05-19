<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $especes = [
            ['espece' => 'Lion', 'image' => 'Lion.jpg', 'habitat' => 'savane'],
            ['espece' => 'Lionne', 'image' => 'Lions.jpg', 'habitat' => 'savane'],
            ['espece' => 'Rhinoceros', 'image' => 'Rhinoceros.jpg', 'habitat' => 'savane'],
            ['espece' => 'Zebre', 'image' => 'Zebre.jpg', 'habitat' => 'plaine_herbivore'],
            ['espece' => 'Giraffe', 'image' => 'Giraffe.jpg', 'habitat' => 'plaine_herbivore'],
            ['espece' => 'Dain', 'image' => 'Dain.jpg', 'habitat' => 'plaine_herbivore'],
            ['espece' => 'Cheveaux', 'image' => 'Cheveaux.jpg', 'habitat' => 'ecurie'],
            ['espece' => 'Lama', 'image' => 'Lama.jpg', 'habitat' => 'ecurie'],
            ['espece' => 'Perroquet', 'image' => 'Perroquet.jpg', 'habitat' => 'cage_a_oiseaux'],
            ['espece' => 'Chevêche', 'image' => 'Cheveche.jpg', 'habitat' => 'cage_a_oiseaux'],
            ['espece' => 'Cigogne blanche', 'image' => 'Cigogne_blanche.jpg', 'habitat' => 'cours_d_eau_naturel'],
            ['espece' => 'Milan noir', 'image' => 'Milan_noir.jpg', 'habitat' => 'cours_d_eau_naturel'],
            ['espece' => 'Caimen', 'image' => 'Caimen.jpg', 'habitat' => 'eaux_des_crocodiles'],
            ['espece' => 'Gorille des plaines', 'image' => 'Gorille.jpg', 'habitat' => 'foret_de_singes'],
            ['espece' => 'Macaque crabier', 'image' => 'Macaque_crabier.jpg', 'habitat' => 'foret_de_singes'],
            ['espece' => 'Lémurien', 'image' => 'Lémurien.jpg', 'habitat' => 'foret_de_singes'],
            ['espece' => 'Renard', 'image' => 'Renard.jpg', 'habitat' => 'savane'],
            ['espece' => 'Suricates', 'image' => 'Suricates.jpg', 'habitat' => 'savane'],
            ['espece' => 'Panthère des neiges', 'image' => 'Panthere_neige.jpg', 'habitat' => 'savane'],
            ['espece' => 'Iguane Vert', 'image' => 'Iguana.jpg', 'habitat' => 'plaine_des_reptiles'],
            ['espece' => 'Serpent roi', 'image' => 'Serpent_roi.jpg', 'habitat' => 'plaine_des_reptiles'],
            ['espece' => 'Chameleon', 'image' => 'chameleon.jpg', 'habitat' => 'plaine_des_reptiles'],
            ['espece' => 'Raton laveur', 'image' => 'Raton_laveur.jpg', 'habitat' => 'foret_de_singes'],
        ];

        foreach ($especes as $data) {
            $animal = new Animal();
            $animal->setNom($faker->firstName);
            $animal->setEspece($data['espece']);
            $animal->setImg($data['image']);

            // getReference avec 2 arguments : nom de référence + la class hérité pour éviter une erréur
            $habitat = $this->getReference($data['habitat'], \App\Entity\Habitat::class);
            $animal->setHabitat($habitat);

            $manager->persist($animal);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [HabitatFixture::class];
    }
}
