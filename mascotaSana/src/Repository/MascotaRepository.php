<?php

namespace App\Repository;

use App\Entity\Mascota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mascota>
 *
 * @method Mascota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mascota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mascota[]    findAll()
 * @method Mascota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MascotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mascota::class);
    }

   /**
    * Mascotas por propietarios
    * @return array 
    */
   public function mascotasPropietarios(): array
   {
        return $this->createQueryBuilder('m')
        ->join('m.propietario', 'p')
        ->groupBy('p.id')
        ->getQuery()
        ->getResult();

   }

   /**
    * Mascotas por Tipo
    * @return array 
    */
   public function mascotasPorTipo(): array
{
    return $this->createQueryBuilder('m')
        ->groupBy('m.tipo')
        ->getQuery()
        ->getResult();
}

   /**
    * Mascotas por raza
    * @return array 
    */
public function mascotasPorRaza(): array
{
    return $this->createQueryBuilder('m')
        ->groupBy('m.raza')
        ->getQuery()
        ->getResult();
}

//    public function findOneBySomeField($value): ?Mascota
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
