<?php

// src/Repository/AnimalRepository.php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * Recherche des animaux avec des critères dynamiques.
     *
     * @param array $filters Tableau des critères de filtrage
     * @return Animal[] Liste des animaux correspondant aux critères
     */
    public function findByFilters(array $filters)
    {
        $queryBuilder = $this->createQueryBuilder('a');

        // Appliquer les filtres dynamiquement
        if (isset($filters['name'])) {
            $queryBuilder->andWhere('a.name LIKE :name')
                ->setParameter('name', '%' . $filters['name'] . '%');
        }

        if (isset($filters['type'])) {
            $queryBuilder->andWhere('a.type = :type')
                ->setParameter('type', $filters['type']);
        }

        if (isset($filters['breed'])) {
            $queryBuilder->andWhere('a.breed = :breed')
                ->setParameter('breed', $filters['breed']);
        }

        if (isset($filters['status'])) {
            $queryBuilder->andWhere('a.status = :status')
                ->setParameter('status', $filters['status']);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}


?>