<?php

namespace App\Repository;

use App\Entity\Hands;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hands>
 *
 * @method Hands|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hands|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hands[]    findAll()
 * @method Hands[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hands::class);
    }

//    /**
//     * @return Hands[] Returns an array of Hands objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Hands
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
