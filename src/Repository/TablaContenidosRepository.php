<?php

namespace App\Repository;

use App\Entity\TablaContenidos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TablaContenidos>
 *
 * @method TablaContenidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method TablaContenidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method TablaContenidos[]    findAll()
 * @method TablaContenidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TablaContenidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TablaContenidos::class);
    }

    public function add(TablaContenidos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TablaContenidos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllTCParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM tabla_contenidos WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function addTCParaUnCurso($id, $titulo, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO tabla_contenidos (id_curso_id, titulo, descripcion)
        VALUES ('$id', '$titulo', '$desc')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function editTCParaUnCurso($id, $titulo, $desc)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE tabla_contenidos SET titulo = '$titulo', descripcion = '$desc'
        WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function deleteTCParaUnCurso($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM tabla_contenidos WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return TablaContenidos[] Returns an array of TablaContenidos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TablaContenidos
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
