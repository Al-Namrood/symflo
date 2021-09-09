<?php

namespace App\Repository;

use App\Entity\HistoryMatchStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoryMatchStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoryMatchStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoryMatchStats[]    findAll()
 * @method HistoryMatchStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryMatchStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoryMatchStats::class);
    }

    // /**
    //  * @return HistoryMatchStats[] Returns an array of HistoryMatchStats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoryMatchStats
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
