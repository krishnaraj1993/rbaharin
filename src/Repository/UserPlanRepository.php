<?php

namespace App\Repository;

use App\Entity\UserPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method UserPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPlan[]    findAll()
 * @method UserPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPlan::class);
    }

    public function getAll()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }

    public function getByCondition()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }
}
