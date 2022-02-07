<?php

namespace App\Repository;

use App\Entity\CpBooker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CpBooker|null find($id, $lockMode = null, $lockVersion = null)
 * @method CpBooker|null findOneBy(array $criteria, array $orderBy = null)
 * @method CpBooker[]    findAll()
 * @method CpBooker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpBookerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CpBooker::class);
    }

    // /**
    //  * @return CpBooker[] Returns an array of CpBooker objects
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
    public function findOneBySomeField($value): ?CpBooker
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
