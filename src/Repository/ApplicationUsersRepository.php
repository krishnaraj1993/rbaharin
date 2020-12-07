<?php

namespace App\Repository;

use App\Constants\StatusConstants;
use App\Entity\ApplicationUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApplicationUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationUsers[]    findAll()
 * @method ApplicationUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationUsers::class);
    }

    public function listUsers($role, $id = null)
    {
        $qry = $this->createQueryBuilder('a')
            ->addSelect('r')
            ->join('a.userId', 'r');
        $roles = explode(',', $role);
        foreach ($roles as $key => $value) {
            $qry = $qry->orWhere('r.roles LIKE :role_' . $key)
                ->setParameter('role_' . $key, '%"' . $value . '"%');
        }
        if ($id != null) {
            $qry = $qry->andWhere('a.subUsers = :parent')
                ->setParameter('parent', $id);
        }

        $result = $qry->getQuery()
            ->setMaxResults(5)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;

    }

    public function usersCount($role, $id = null)
    {
        $qry = $this->createQueryBuilder('a')
            ->addSelect('r')
            ->join('a.userId', 'r')
            ->andWhere('r.roles LIKE :role')
            ->setParameter('role', '%"' . $role . '"%');
        if ($id != null) {
            $qry = $qry->andWhere('a.subUsers = :parent')
                ->setParameter('parent', $id);
        }

        $result = $qry->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }

    public function getRequestedPlansList()
    {
        $result = $this->createQueryBuilder('a')
            ->addSelect('
            a.id as user,
            a.firstname as firstname,
            a.lastname as lastname,
            a.mobilenumber as mobilenumber,
            c.id as plan,
            c.title as title,
            p.title as ptitle
            ')
            ->join('a.currentPlan', 'c')
            ->join('a.prevPlan', 'p')
            ->andWhere('a.planStatus = :plan')
            ->setParameter('plan', StatusConstants::PENDING)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $result;
    }

    public function usersTree($role, $id = null)
    {
        $qry = $this->createQueryBuilder('a')
            ->addSelect('r')
            ->join('a.userId', 'r')
            ->andWhere('r.roles LIKE :role')
            ->setParameter('role', '%"' . $role . '"%');
        if ($id != null) {
            $qry = $qry->andWhere('a.subUsers = :parent')
                ->setParameter('parent', $id);
        }
        $result = $qry->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }

    public function profile($id)
    {
        $qry = $this->createQueryBuilder('a')
            ->addSelect('u')
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->join('a.userId', 'u');
        $result = $qry->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }
}
