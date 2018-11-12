<?php

namespace App\Repository;

use App\Entity\AplicacionTraduccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AplicacionTraduccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AplicacionTraduccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AplicacionTraduccion[]    findAll()
 * @method AplicacionTraduccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AplicacionTraduccionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AplicacionTraduccion::class);
    }


    public function llistadoAplicacion($idioma){


        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'select t 
            from  App:AplicacionTraduccion t  
            where t.idioma=:idioma'
        )->setParameter('idioma',$idioma);

        $aplicaciones=$query->getResult();
        return ($aplicaciones);
    }

/*
    public function findByIdiomaAplicacion($value1=1,$value2='es'){

        $parameters=array(
            'value1'=>$value1,
            'value2'=>$value2
        );

        $entityManager=$this->getEntityManager();
        $dql='select a.nombre  
            from App:AplicacionTraduccion a, App:Solicitud s 
            where a.aplicacion=s.aplicacion and 
            s.id=:value1 and 
            a.idioma=:value2';

        $query=$entityManager->createQuery($dql)
            ->setParameter('value1',$value1)
            ->setParameter('value2',$value2);

        $nombreaplicacion=$query->getResult();
        return ($nombreaplicacion);


        return $this->createQueryBuilder('at')
            ->innerJoin('at.aplicacion', 'aplicacion', 'aplicacion.id = at.aplicacion')
            ->andWhere('at.idioma = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;

    }
    */

//    /**
//     * @return AplicacionTraduccion[] Returns an array of AplicacionTraduccion objects
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
    public function findOneBySomeField($value): ?AplicacionTraduccion
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
