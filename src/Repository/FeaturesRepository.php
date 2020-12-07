<?php

namespace App\Repository;

use App\Entity\Features;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Features|null find($id, $lockMode = null, $lockVersion = null)
 * @method Features|null findOneBy(array $criteria, array $orderBy = null)
 * @method Features[]    findAll()
 * @method Features[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeaturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Features::class);
    }

    public function feathAll()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}
