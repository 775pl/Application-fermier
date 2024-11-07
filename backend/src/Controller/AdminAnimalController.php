<?php
namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAnimalController extends AbstractController
{
    #[Route('/admin/animals', name: 'admin_animal_list', methods: ['GET'])]
    public function list(AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findAll();

        return $this->json($animals);
    }

    #[Route('/admin/animal', name: 'admin_animal_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);

        $animal = new Animal();
        $animal->setName($data['name']);
        $animal->setAge($data['age']);
        $animal->setType($data['type']);
        $animal->setBreed($data['breed']);
        $animal->setDescription($data['description']);
        $animal->setStatus($data['status']);
        $animal->setPriceHT($data['priceHT']);
        $animal->setPhotos($data['photos']);

        $em->persist($animal);
        $em->flush();

        return $this->json($animal, Response::HTTP_CREATED);
    }

    #[Route('/admin/animal/{id}', name: 'admin_animal_update', methods: ['PUT'])]
    public function update(int $id, Request $request, AnimalRepository $animalRepository, EntityManagerInterface $em): Response
    {
        $animal = $animalRepository->find($id);
        $data = json_decode($request->getContent(), true);

        if ($animal) {
            $animal->setName($data['name']);
            $animal->setAge($data['age']);
            $animal->setType($data['type']);
            $animal->setBreed($data['breed']);
            $animal->setDescription($data['description']);
            $animal->setStatus($data['status']);
            $animal->setPriceHT($data['priceHT']);
            $animal->setPhotos($data['photos']);

            $em->flush();

            return $this->json($animal);
        }

        return $this->json(['error' => 'Animal not found'], Response::HTTP_NOT_FOUND);
    }

    #[Route('/admin/animal/{id}', name: 'admin_animal_delete', methods: ['DELETE'])]
    public function delete(int $id, AnimalRepository $animalRepository, EntityManagerInterface $em): Response
    {
        $animal = $animalRepository->find($id);

        if ($animal) {
            $em->remove($animal);
            $em->flush();

            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return $this->json(['error' => 'Animal not found'], Response::HTTP_NOT_FOUND);
    }
}
?>