<?php

namespace App\Repository;

use App\Entity\ContactStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactStatus>
 *
 * @method ContactStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactStatus[]    findAll()
 * @method ContactStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactStatus::class);
    }

//    /**
//     * @return ContactStatus[] Returns an array of ContactStatus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContactStatus
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
