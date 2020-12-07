<?php

namespace App\Repository;

use App\Entity\Ewa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Ewa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ewa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ewa[]    findAll()
 * @method Ewa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EwaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ewa::class);
    }

    public function feathAll()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}
