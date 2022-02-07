<?php

namespace App\Repository;

use App\Entity\CpHall;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CpHall|null find($id, $lockMode = null, $lockVersion = null)
 * @method CpHall|null findOneBy(array $criteria, array $orderBy = null)
 * @method CpHall[]    findAll()
 * @method CpHall[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpHallRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CpHall::class);
    }

    // /**
    //  * @return CpHall[] Returns an array of CpHall objects
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
    public function findOneBySomeField($value): ?CpHall
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
