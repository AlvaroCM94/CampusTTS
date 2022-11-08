<?php

namespace App\Repository;

use App\Entity\InstructorUsuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InstructorUsuario>
 *
 * @method InstructorUsuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstructorUsuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstructorUsuario[]    findAll()
 * @method InstructorUsuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstructorUsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstructorUsuario::class);
    }

    public function add(InstructorUsuario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InstructorUsuario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getUsuariosPorId($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM instructor_usuario WHERE alumno_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAlumnosIdPorInstructorId($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT alumno_id FROM instructor_usuario WHERE instructor_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAlumnosIdPorInstructorIdYActivos($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT alumno_id FROM instructor_usuario WHERE instructor_id='$id' AND activo=1";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }



//    /**
//     * @return InstructorUsuario[] Returns an array of InstructorUsuario objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InstructorUsuario
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
