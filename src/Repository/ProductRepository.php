<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    // public function findByFilters($filters)
    // {
    //     $qb = $this->createQueryBuilder('p');

    //     $qb->leftJoin('p.category', 'c');

    //     // Initialisation d'un tableau pour stocker les conditions de catégorie
    //     $categoryConditions = [];

    //     // Exemple de condition pour les catégories
    //     if ($filters['heritage']) {
    //         $categoryConditions[] = $qb->expr()->eq('c.name', ':heritage');
    //     }
    //     if ($filters['oceanic']) {
    //         $categoryConditions[] = $qb->expr()->eq('c.name', ':oceanic');
    //     }
    //     if ($filters['prestige']) {
    //         $categoryConditions[] = $qb->expr()->eq('c.name', ':prestige');
    //     }
    //     if ($filters['homme']) {
    //         $categoryConditions[] = $qb->expr()->eq('c.name', ':homme');
    //     }
    //     if ($filters['femme']) {
    //         $categoryConditions[] = $qb->expr()->eq('c.name', ':femme');
    //     }

    //     // Combinez les conditions de catégorie avec un opérateur OR
    //     if (!empty($categoryConditions)) {
    //         $qb->andWhere(implode(' OR ', $categoryConditions));
    //     }

    //     // Initialisation d'un tableau pour stocker les conditions de prix
    //     $priceConditions = [];

    //     // Exemple de condition pour les plages de prix
    //     if ($filters['-10000']) {
    //         $priceConditions[] = $qb->expr()->lt('p.unitPrice', 10000);
    //     }
    //     if ($filters['10000-20000']) {
    //         $priceConditions[] = $qb->expr()->between('p.unitPrice', 10000, 20000);
    //     }
    //     if ($filters['20000-40000']) {
    //         $priceConditions[] = $qb->expr()->between('p.unitPrice', 20000, 40000);
    //     }
    //     if ($filters['40000-60000']) {
    //         $priceConditions[] = $qb->expr()->between('p.unitPrice', 40000, 60000);
    //     }
    //     if ($filters['60000-80000']) {
    //         $priceConditions[] = $qb->expr()->between('p.unitPrice', 60000, 80000);
    //     }
    //     if ($filters['+80000']) {
    //         $priceConditions[] = $qb->expr()->gte('p.price', 80000);
    //     }

    //     // Combinez les conditions de prix avec un opérateur OR
    //     if (!empty($priceConditions)) {
    //         $qb->andWhere(implode(' OR ', $priceConditions));
    //     }

    //     // Paramétrage des filtres de catégories
    //     if ($filters['heritage']) {
    //         $qb->setParameter('heritage', 'Heritage');
    //     }
    //     if ($filters['oceanic']) {
    //         $qb->setParameter('oceanic', 'Oceanic');
    //     }
    //     if ($filters['prestige']) {
    //         $qb->setParameter('prestige', 'Prestige');
    //     }
    //     if ($filters['femme']) {
    //         $qb->setParameter('femme', 'Femme');
    //     }
    //     if ($filters['homme']) {
    //         $qb->setParameter('homme', 'Homme');
    //     }

    //     return $qb->getQuery()->getResult();
    // }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
     public function findByFilters($filters)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->leftJoin('p.category', 'c');

        // Initialisation d'un tableau pour stocker les conditions de catégorie
        $categoryConditions = [];

        // Exemple de condition pour les catégories
        if ($filters['heritage']) {
            $categoryConditions[] = $qb->expr()->eq('c.name', ':heritage');
        }
        if ($filters['oceanic']) {
            $categoryConditions[] = $qb->expr()->eq('c.name', ':oceanic');
        }
        if ($filters['prestige']) {
            $categoryConditions[] = $qb->expr()->eq('c.name', ':prestige');
        }
        if ($filters['homme']) {
            $categoryConditions[] = $qb->expr()->eq('c.name', ':homme');
        }
        if ($filters['femme']) {
            $categoryConditions[] = $qb->expr()->eq('c.name', ':femme');
        }

        // Combinez les conditions de catégorie avec un opérateur OR
        if (!empty($categoryConditions)) {
            $qb->andWhere(implode(' OR ', $categoryConditions));
        }

        // Initialisation d'un tableau pour stocker les conditions de prix
        $priceConditions = [];

        // Exemple de condition pour les plages de prix
        if ($filters['-10000']) {
            $priceConditions[] = $qb->expr()->lt('p.unitPrice', 10000);
        }
        if ($filters['10000-20000']) {
            $priceConditions[] = $qb->expr()->between('p.unitPrice', 10000, 20000);
        }
        if ($filters['20000-40000']) {
            $priceConditions[] = $qb->expr()->between('p.unitPrice', 20000, 40000);
        }
        if ($filters['40000-60000']) {
            $priceConditions[] = $qb->expr()->between('p.unitPrice', 40000, 60000);
        }
        if ($filters['60000-80000']) {
            $priceConditions[] = $qb->expr()->between('p.unitPrice', 60000, 80000);
        }
        if ($filters['+80000']) {
            $priceConditions[] = $qb->expr()->gte('p.price', 80000);
        }

        // Combinez les conditions de prix avec un opérateur OR
        if (!empty($priceConditions)) {
            $qb->andWhere(implode(' OR ', $priceConditions));
        }

        // Paramétrage des filtres de catégories
        if ($filters['heritage']) {
            $qb->setParameter('heritage', 'Heritage');
        }
        if ($filters['oceanic']) {
            $qb->setParameter('oceanic', 'Oceanic');
        }
        if ($filters['prestige']) {
            $qb->setParameter('prestige', 'Prestige');
        }
        if ($filters['femme']) {
            $qb->setParameter('femme', 'Femme');
        }
        if ($filters['homme']) {
            $qb->setParameter('homme', 'Homme');
        }

        return $qb->getQuery()->getResult();
    }
}
