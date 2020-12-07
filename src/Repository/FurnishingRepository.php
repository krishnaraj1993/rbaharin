<?php

namespace App\Repository;

use App\Entity\Furnishing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Furnishing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Furnishing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Furnishing[]    findAll()
 * @method Furnishing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FurnishingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Furnishing::class);
    }

    public function feathAll()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}
