<?php

namespace App\Repository;

use App\Entity\CpConcert;use App\Entity\CpBand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CpConcert|null find($id, $lockMode = null, $lockVersion = null)
 * @method CpConcert|null findOneBy(array $criteria, array $orderBy = null)
 * @method CpConcert[]    findAll()
 * @method CpConcert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpConcertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CpConcert::class);
    }

    // /**
    //  * @return CpConcert[] Returns an array of CpConcert objects
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
    public function findOneBySomeField($value): ?CpConcert
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return CpConcert[] Returns an array of CpConcert objects
    */
    
    public function incomingConcerts(int $fr)
    {
        $debut = $fr*2;
        return $this->createQueryBuilder('c')
            ->andWhere('c.date > :val')
            ->setParameter('val', date("Y-m-d"))
            ->orderBy('c.date', 'ASC')
            ->setFirstResult($fr)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return CpConcert[] Returns an array of CpConcert objects
    */

    public function incomingConcertsByBand(int $bandId)
    {
        return $this->createQueryBuilder('c')
            ->join(CpBand::class, "b")
            ->andWhere('c.date > :val')
            ->andWhere('b.id = :id')
            ->setParameter('val', date("Y-m-d"))
            ->setParameter('id', $bandId)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    
}
