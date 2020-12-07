<?php

namespace App\Repository;

use App\Entity\NearBy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NearBy|null find($id, $lockMode = null, $lockVersion = null)
 * @method NearBy|null findOneBy(array $criteria, array $orderBy = null)
 * @method NearBy[]    findAll()
 * @method NearBy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NearByRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NearBy::class);
    }

    // /**
    //  * @return NearBy[] Returns an array of NearBy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NearBy
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
