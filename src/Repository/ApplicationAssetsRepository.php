<?php

namespace App\Repository;

use App\Entity\ApplicationAssets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApplicationAssets|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationAssets|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationAssets[]    findAll()
 * @method ApplicationAssets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationAssetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationAssets::class);
    }

    // /**
    //  * @return ApplicationAssets[] Returns an array of ApplicationAssets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApplicationAssets
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
