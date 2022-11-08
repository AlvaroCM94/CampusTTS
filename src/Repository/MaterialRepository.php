<?php

namespace App\Repository;

use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Material>
 *
 * @method Material|null find($id, $lockMode = null, $lockVersion = null)
 * @method Material|null findOneBy(array $criteria, array $orderBy = null)
 * @method Material[]    findAll()
 * @method Material[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Material::class);
    }

    public function add(Material $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Material $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllMatParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM material WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function addMatParaUnCurso($idCurso, $titulo, $enlace, $tema, $desc, $visibilidad, $tipo)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO material (id_curso_id, titulo, enlace, tema, descripcion, visibilidad, tipo)
        VALUES ('$idCurso', '$titulo', '$enlace', '$tema', '$desc', '$visibilidad', '$tipo')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function editMatParaUnCurso($id, $titulo, $enlace, $tema, $desc, $visibilidad, $tipo)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE material SET titulo = '$titulo', enlace = '$enlace', tema  = '$tema', descripcion = '$desc', visibilidad = '$visibilidad', tipo = '$tipo'
        WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        //dd($stmt);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function deleteMatParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM material WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return Material[] Returns an array of Material objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Material
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
