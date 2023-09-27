<?php

namespace App\Repository;

use App\Entity\AdminNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdminNotes>
 *
 * @method AdminNotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminNotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminNotes[]    findAll()
 * @method AdminNotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminNotesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminNotes::class);
    }

//    /**
//     * @return AdminNotes[] Returns an array of AdminNotes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AdminNotes
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
