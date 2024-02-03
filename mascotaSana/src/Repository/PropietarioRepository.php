<?php

namespace App\Repository;

use App\Entity\Propietario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Propietario>
 *
 * @method Propietario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Propietario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Propietario[]    findAll()
 * @method Propietario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropietarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Propietario::class);
    }

    /**
     * @return Propietario[] Returns an array of Propietario objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.mascotas = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Propietario
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
