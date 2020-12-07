<?php

namespace App\Repository;

use App\Entity\PropertyStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method PropertyStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyStatus[]    findAll()
 * @method PropertyStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropertyStatus::class);
    }

    public function feathAll()
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();
        return $result = $query->getResult(Query::HYDRATE_ARRAY);
    }

}
