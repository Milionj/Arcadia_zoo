<?php

namespace App\DataFixtures;

use App\Entity\VisiteVeterinaire;
use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VisiteVeterinaireFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // On récupère les animaux depuis la BDD (AnimalFixture déjà chargée)
        $animaux = $manager->getRepository(Animal::class)->findAll();

        foreach ($animaux as $animal) {
            $visite = new VisiteVeterinaire();
            $visite->setAnimal($animal);
            $visite->setDatePassage($faker->dateTimeBetween('-3 months', 'now'));
            $visite->setDiagnosticAnimal($faker->randomElement([
                'Contrôle de routine',
                'Blessure soignée',
                'Problème digestif',
                'Vaccination annuelle',
                'Perte de poids surveillée'
            ]));
            $visite->setNourriturePropose($faker->randomElement([
                'Foin enrichi',
                'Fruits frais',
                'Viande crue',
                'Légumes cuits',
                'Graines spéciales'
            ]));
            $visite->setGrammageNourriture((string) $faker->randomFloat(1, 0.5, 5));

            $manager->persist($visite);
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
