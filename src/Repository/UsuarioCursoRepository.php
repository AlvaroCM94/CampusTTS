<?php

namespace App\Repository;

use App\Entity\UsuarioCurso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UsuarioCurso>
 *
 * @method UsuarioCurso|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioCurso|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioCurso[]    findAll()
 * @method UsuarioCurso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioCursoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioCurso::class);
    }

    public function add(UsuarioCurso $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UsuarioCurso $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function inscribirUser($idUser, $idCurso, $tipo)
    {
        $conn = $this->getEntityManager()->getConnection();

        if($tipo == "CON"){
            $sql = "INSERT INTO usuario_curso (id_usuario_id, id_curso_id, estado)
                    VALUES ('$idUser', '$idCurso', '1 Video, cuestionario y cita')";
        }else if($tipo == "SIN"){
            $sql = "INSERT INTO usuario_curso (id_usuario_id, id_curso_id, estado)
                    VALUES ('$idUser', '$idCurso', '0 Curso sin pasos')";
        }

        $stmt = $conn->prepare($sql);
        //dd($stmt);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getIdCursosDeUnInstructor($idInstructor)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT id_curso_id FROM usuario_curso WHERE id_usuario_id='$idInstructor'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getIdAlumnosDeUnInstructor($idInstructor, $idCursosDeUnInstructor)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT id_usuario_id FROM usuario_curso WHERE id_curso_id='$idCursosDeUnInstructor' AND NOT id_usuario_id='$idInstructor' ";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getEstado($idAlumnosDeUnInstructor)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT estado FROM usuario_curso WHERE id_usuario_id='$idAlumnosDeUnInstructor' ";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    //getEstado

//    /**
//     * @return UsuarioCurso[] Returns an array of UsuarioCurso objects
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

//    public function findOneBySomeField($value): ?UsuarioCurso
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
