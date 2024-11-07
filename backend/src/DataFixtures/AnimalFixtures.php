<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Créé une instance de Faker pour générer des données aléatoires
        $faker = Factory::create();

        // Définition des types et races autorisés, avec une association entre les deux
        $allowedPairs = [
            'chien' => ['labrador'],
            'cheval' => ['frison', 'irish cob'],
            'brebis' => ['mérinos', 'solognotes'],
            'cochon' => ['pottok'],
        ];

        // Créé 10 animaux fictifs
        for ($i = 0; $i < 10; $i++) {
            // Choisir un type aléatoire
            $type = $faker->randomElement(array_keys($allowedPairs));

            // Choisir une race aléatoire compatible avec le type
            $breed = $faker->randomElement($allowedPairs[$type]);

            $animal = new Animal();
            $animal->setName($faker->name)
                ->setAge($faker->numberBetween(1, 15))
                ->setType($type)
                ->setBreed($breed)
                ->setDescription($faker->paragraph)
                ->setPriceHT($faker->randomFloat(2, 50, 1000))
                ->setStatus($faker->randomElement(['Available', 'Adopted', 'Lost']))
                ->setPhotos($faker->imageUrl(640, 480, 'animals'));

            $manager->persist($animal);
        }

        // Sauvegarde les animaux dans la base de données
        $manager->flush();
    }
}