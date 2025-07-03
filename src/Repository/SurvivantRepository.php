<?php

namespace App\Repository;

use App\Entity\Survivant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Survivant>
 */
class SurvivantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Survivant::class);
    }

    public function orderReverse(){
        return $this->createQueryBuilder('s')
               ->orderBy('s.nom', 'DESC')
               ->getQuery()
               ->getResult();
    }
    public function nain($value){
        return $this->createQueryBuilder('s')
                ->leftJoin('s.race', 'r')
               ->andWhere('r.race_name = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getResult();
    }
    public function elf($race, $puissance){
        return $this->createQueryBuilder('s')
                ->leftJoin('s.race', 'r')
               ->andWhere('r.race_name = :race')
               ->andWhere('s.puissance > :pui')
               ->setParameter('race', $race)
               ->setParameter('pui', $puissance)
               ->getQuery()
               ->getResult();
    }
    //    /**
    //     * @return Survivant[] Returns an array of Survivant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Survivant
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


}
