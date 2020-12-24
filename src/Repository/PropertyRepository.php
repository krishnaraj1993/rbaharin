<?php

namespace App\Repository;

use App\Constants\StatusConstants;
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

    public function getAll($request)
    {
        return $this->createQueryBuilder('p')
            ->Where('p.status != :status_')
            ->setParameter('status_', StatusConstants::DELETED)
            ->setMaxResults(5)
            ->setFirstResult($request['page'])
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }
    public function getAllByUser($id, $request)
    {
        return $this->createQueryBuilder('p')
            ->Where('p.createdBy = :id')
            ->join('App:PropertyDetails', 'pd', 'WITH', 'pd.parent = p.id')
            ->setParameter('id', $id)
            ->andWhere('p.status != :status_')
            ->setParameter('status_', StatusConstants::DELETED)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }
    public function getAllById($id)
    {
        return $this->createQueryBuilder('p')
            ->addSelect(
                'ps.id as pstatus,
                pt.id as ptype,
                pe.id as ewa,
                pf.id as furnishing,
                pd.SeoTags,
                pd.city,
                pd.state,
                pd.zip
                ')
            ->join('p.propertyStatus', 'ps')
            ->join('p.propertyType', 'pt')
            ->join('p.ewa', 'pe')
            ->join('App:PropertyDetails', 'pd', 'WITH', 'pd.parent = p.id')
            ->join('p.furnishing', 'pf')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->andWhere('p.status != :status_')
            ->setParameter('status_', StatusConstants::DELETED)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

    }

    public function getFilterData($param, $type = 'default', $advanced = null)
    {
        $qb = $this->createQueryBuilder('p')
            ->join('App:PropertyDetails', 'pd', 'WITH', 'pd.parent = p.id')
            ->join('p.propertyType', 'pt')
            ->Where('p.status != :status_')
            ->setParameter('status_', StatusConstants::DELETED);
        if ($type == 'default') {
            $i = 1;
            foreach ($param as $key => $value) {
                $qb = $qb->andWhere($key . ' = :datakey' . $i)
                    ->setParameter('datakey' . $i, $value);
            }
        }
        if ($type == 'search') {
            $i = 400;
            foreach ($param as $key => $value) {
                if (!empty($value)) {
                    $qb = $qb->andWhere($key . ' LIKE :datakey' . $i)
                        ->setParameter('datakey' . $i, '%' . $value . '%');
                    $i++;
                }
            }
        }
        if (!empty($advanced)) {
            if (!empty($advanced['btw'])) {
                $i = 200;
                foreach ($advanced['btw'] as $key => $value) {
                    $qb = $qb->andWhere($key . ' > :dataval1' . $i . " AND " . $key . '< :dataval2' . $i)
                        ->setParameter('dataval1' . $i, (int)$value[0])
                        ->setParameter('dataval2' . $i, (int)$value[1]);
                    $i++;
                }
            }
        }
        $qb = $qb->getQuery();
        return $qb = $qb->getResult(Query::HYDRATE_ARRAY);
    }
}
