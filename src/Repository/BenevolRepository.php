<?php

namespace App\Repository;

use App\Entity\Benevol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Benevol>
 *
 * @method Benevol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Benevol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Benevol[]    findAll()
 * @method Benevol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BenevolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Benevol::class);
    }

//    /**
//     * @return Benevol[] Returns an array of Benevol objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Benevol
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
