<?php

namespace App\Repository;

use App\Entity\CpMember;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CpMember|null find($id, $lockMode = null, $lockVersion = null)
 * @method CpMember|null findOneBy(array $criteria, array $orderBy = null)
 * @method CpMember[]    findAll()
 * @method CpMember[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpMemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CpMember::class);
    }

    // /**
    //  * @return CpMember[] Returns an array of CpMember objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CpMember
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
