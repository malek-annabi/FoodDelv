<?php

namespace App\Repository;

use App\Entity\DeliveryGuy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeliveryGuy|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryGuy|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryGuy[]    findAll()
 * @method DeliveryGuy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryGuyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryGuy::class);
    }

    // /**
    //  * @return DeliveryGuy[] Returns an array of DeliveryGuy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeliveryGuy
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
