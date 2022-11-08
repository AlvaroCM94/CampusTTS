<?php

namespace App\Repository;

use App\Entity\Objetivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Objetivo>
 *
 * @method Objetivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objetivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objetivo[]    findAll()
 * @method Objetivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objetivo::class);
    }

    public function add(Objetivo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Objetivo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllObjParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM objetivo WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function addObjParaUnCurso($id, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO objetivo (id_curso_id, descripcion)
        VALUES ('$id', '$desc')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function editObjParaUnCurso($id, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE objetivo SET descripcion = '$desc'
        WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function deleteObjParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM objetivo WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return Objetivo[] Returns an array of Objetivo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Objetivo
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
