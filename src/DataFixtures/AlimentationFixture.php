<?php

namespace App\DataFixtures;

use App\Entity\Alimentation;
use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AlimentationFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        /** @var Animal[] $animals */
        $animals = $manager->getRepository(Animal::class)->findAll();

        // Dictionnaire nourriture par espèce clé => valeur
            $nourritureParEspece = [
            'Lion' => ['Viande', 'Poulet cru', 'Abats'],
            'Lionne' => ['Viande', 'Poulet cru', 'Abats'],
            'Raton laveur' => ['Fruits', 'Insectes', 'Oeufs'],
            'Lémurien' => ['Fruits tropicaux', 'Feuilles', 'Fleurs'],
            'Caimen' => ['Poissons', 'Viande crue', 'Oiseaux'],
            'Renard' => ['Petits animaux', 'Viande', 'Fruits'],
            'Cheveaux' => ['Foin', 'Paille', 'Pommes'],
            'Chameleon' => ['Insectes', 'Criquets', 'Larves'],
            'Dain' => ['Herbe', 'Foin', 'Feuilles'],
            'Milan noir' => ['Petits mammifères', 'Poissons', 'Charognes'],
            'Cigogne blanche' => ['Grenouilles', 'Insectes', 'Poissons'],
            'Giraffe' => ['Feuilles d’acacia', 'Foin', 'Branches tendres'],
            'Gorille des plaines' => ['Fruits', 'Feuilles', 'Tiges'],
            'Iguane Vert' => ['Légumes', 'Feuilles vertes', 'Fruits'],
            'Panthère des neiges' => ['Viande', 'Petits rongeurs', 'Oiseaux'],
            'Lama' => ['Foin', 'Herbes sèches', 'Grains'],
            'Suricates' => ['Insectes', 'Larves', 'Petits reptiles'],
            'Macaque crabier' => ['Fruits', 'Crustacés', 'Feuilles'],
            'Chevêche' => ['Insectes', 'Rongeurs', 'Oisillons'],
            'Perroquet' => ['Graines', 'Fruits', 'Noix'],
            'Rhinoceros' => ['Herbe', 'Feuilles', 'Écorces'],
            'Serpent roi' => ['Rongeurs', 'Oeufs', 'Petits reptiles'],
            'Zebre' => ['Herbe', 'Foin', 'Légumes'],
];


        foreach ($animals as $animal) {
            $espece = $animal->getEspece();
            $nourritures = $nourritureParEspece[$espece] ?? ['Nourriture standard'];

            $alimentation = new Alimentation();
            $alimentation->setAnimal($animal);
            $alimentation->setQuantite((string)$faker->randomFloat(1, 0.5, 5)); // en kg ou L selon l'espèce
            $alimentation->setNourriture($faker->randomElement($nourritures));
            $alimentation->setDateAlimentation($faker->dateTimeBetween('-3 days', 'now')); // date + heure

            $manager->persist($alimentation);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AnimalFixture::class,
        ];
    }
}
