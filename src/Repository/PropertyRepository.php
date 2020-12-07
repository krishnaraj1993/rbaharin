<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function getAll()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }
    public function getAllByUser($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.createdBy = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }
    public function getAllById($id)
    {
        return $this->createQueryBuilder('p')
            ->join('p.propertyStatus', 'ps')
            ->join('p.propertyType', 'pt')
            ->join('p.ewa', 'pe')
            ->join('p.furnishing', 'pf')
            ->addSelect('ps.id as pstatus,pt.id as ptype,pe.id as ewa,pf.id as furnishing')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }

    public function getFilterData($param){
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}
