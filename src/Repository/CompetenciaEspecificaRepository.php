<?php

namespace App\Repository;

use App\Entity\CompetenciaEspecifica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetenciaEspecifica>
 *
 * @method CompetenciaEspecifica|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetenciaEspecifica|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetenciaEspecifica[]    findAll()
 * @method CompetenciaEspecifica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetenciaEspecificaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetenciaEspecifica::class);
    }

    public function add(CompetenciaEspecifica $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompetenciaEspecifica $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllCEParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM competencia_especifica WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function addCEParaUnCurso($id, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO competencia_especifica (id_curso_id, descripcion)
        VALUES ('$id', '$desc')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function editCEParaUnCurso($id, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE competencia_especifica SET descripcion = '$desc'
        WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function deleteCEParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM competencia_especifica WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return CompetenciaEspecifica[] Returns an array of CompetenciaEspecifica objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompetenciaEspecifica
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
