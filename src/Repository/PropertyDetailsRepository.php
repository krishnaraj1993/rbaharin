<?php

namespace App\Repository;

use App\Entity\PropertyDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PropertyDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyDetails[]    findAll()
 * @method PropertyDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropertyDetails::class);
    }

    // /**
    //  * @return PropertyDetails[] Returns an array of PropertyDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropertyDetails
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
