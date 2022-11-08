<?php

namespace App\Repository;

use App\Entity\Lugares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lugares>
 *
 * @method Lugares|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lugares|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lugares[]    findAll()
 * @method Lugares[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LugaresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lugares::class);
    }

    public function add(Lugares $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lugares $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllLugares(){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM lugares";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getLugarIdPorNombre($lugar){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT id FROM lugares WHERE nombre = '$lugar'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getLugarPorId($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM lugares WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getLugaresNombrePorId($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT nombre FROM lugares WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return Lugares[] Returns an array of Lugares objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lugares
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
