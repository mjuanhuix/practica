<?php

namespace App\Repository;

use App\Entity\Aplicacion;
use App\Entity\AplicacionTraduccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aplicacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aplicacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aplicacion[]    findAll()
 * @method Aplicacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AplicacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aplicacion::class);
    }

    public function llistadoAplicacion($idioma){


        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'select a,t 
            from App:Aplicacion a, App:AplicacionTraduccion t  
            where t.idioma=:idioma
            and a.id=t.aplicacion
            '
        )->setParameter('idioma',$idioma);

        $aplicaciones=$query->getResult();
        return ($aplicaciones);
    }

//    /**
//     * @return Aplicacion[] Returns an array of Aplicacion objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aplicacion
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
