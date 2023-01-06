<?php

namespace App\Repository;

use App\Entity\UbisoftGames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UbisoftGames>
 *
 * @method UbisoftGames|null find($id, $lockMode = null, $lockVersion = null)
 * @method UbisoftGames|null findOneBy(array $criteria, array $orderBy = null)
 * @method UbisoftGames[]    findAll()
 * @method UbisoftGames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UbisoftGamesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UbisoftGames::class);
    }

    public function save(UbisoftGames $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UbisoftGames $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UbisoftGames[] Returns an array of UbisoftGames objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UbisoftGames
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
