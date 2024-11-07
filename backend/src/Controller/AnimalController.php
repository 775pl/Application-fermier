<?php

// src/Controller/AnimalController.php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnimalController extends AbstractController
{
    #[Route('/api/animals', name: 'api_animals')]
    public function list(AnimalRepository $animalRepository): JsonResponse
    {
        $animals = $animalRepository->findAll();
        $data = [];

        foreach ($animals as $animal) {
            $data[] = [
                'name' => $animal->getName(),
                'age' => $animal->getAge(),
                'type' => $animal->getType(),
                'breed' => $animal->getBreed(),
                'description' => $animal->getDescription(),
                'priceHT' => $animal->getPriceHT(),
                'photos' => $animal->getPhotos(), // Assure-toi que c'est bien une URL
            ];
        }

        return new JsonResponse($data);
    }
}

?>