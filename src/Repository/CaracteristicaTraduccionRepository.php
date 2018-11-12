<?php

namespace App\Repository;

use App\Entity\CaracteristicaTraduccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaracteristicaTraduccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaracteristicaTraduccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaracteristicaTraduccion[]    findAll()
 * @method CaracteristicaTraduccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristicaTraduccionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaracteristicaTraduccion::class);
    }

//    /**
//     * @return CaracteristicaTraduccion[] Returns an array of CaracteristicaTraduccion objects
//     */
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
    public function findOneBySomeField($value): ?CaracteristicaTraduccion
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
