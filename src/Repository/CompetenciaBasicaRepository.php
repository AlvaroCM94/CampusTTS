<?php

namespace App\Repository;

use App\Entity\CompetenciaBasica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetenciaBasica>
 *
 * @method CompetenciaBasica|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetenciaBasica|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetenciaBasica[]    findAll()
 * @method CompetenciaBasica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetenciaBasicaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetenciaBasica::class);
    }

    public function add(CompetenciaBasica $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompetenciaBasica $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllCBParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM competencia_basica WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function addCBParaUnCurso($id, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO competencia_basica (id_curso_id, descripcion)
        VALUES ('$id', '$desc')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function editCBParaUnCurso($id, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE competencia_basica SET descripcion = '$desc'
        WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function deleteCBParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM competencia_basica WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return CompetenciaBasica[] Returns an array of CompetenciaBasica objects
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

//    public function findOneBySomeField($value): ?CompetenciaBasica
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
