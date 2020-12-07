<?php

namespace App\Repository;

use App\Entity\VisitorsWishList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisitorsWishList|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorsWishList|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorsWishList[]    findAll()
 * @method VisitorsWishList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorsWishListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorsWishList::class);
    }

    // /**
    //  * @return VisitorsWishList[] Returns an array of VisitorsWishList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VisitorsWishList
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
