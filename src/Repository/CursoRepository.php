<?php

namespace App\Repository;

use App\Entity\Curso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Mysqli;

/**
 * @extends ServiceEntityRepository<Curso>
 *
 * @method Curso|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curso|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curso[]    findAll()
 * @method Curso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Curso::class);
    }

    public function add(Curso $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Curso $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllCursos(){

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM Curso';
        // dd($conn->prepare($sql));
        $stmt = $conn->prepare($sql);
        // dd($stmt);
        $resultSet = $stmt->executeQuery();

        // dd($resultSet);

        return $resultSet->fetchAllAssociative();
    }

    public function getAllCursosNombres()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT nombre FROM Curso';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllCursosNombresActivos()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT nombre FROM Curso WHERE visibilidad = "1"';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function objetivos($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM objetivo WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function competenciasBasicas($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM competencia_basica WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function competenciasGenerales($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM competencia_generales WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function competenciasEspecificas($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM competencia_especifica WHERE id_curso_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function materiales($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM material WHERE id_curso_id='$id' ORDER BY tema";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getConn()
    {
        return $conn = $this->getEntityManager()->getConnection();
    }

    public function getAllCursosParaUnUsuario($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT id_curso_id FROM usuario_curso WHERE id_usuario_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllInfoCursosParaUnUsuario($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM usuario_curso WHERE id_usuario_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllInfoCursosNombreParaUnUsuario($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT id_curso_id FROM usuario_curso WHERE id_usuario_id='$id'";

        $stmt = $conn->prepare($sql);
        //dd($stmt->executeQuery());
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    public function getAllCursosPorId($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM curso WHERE id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllCursosNombresPorId($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT nombre FROM curso WHERE id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getCursoPorNombre($nombreC)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM curso WHERE nombre='$nombreC'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getEstado($idUsuario, $idCurso)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT estado FROM usuario_curso WHERE id_usuario_id='$idUsuario' AND id_curso_id='$idCurso'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function crearCurso($nombre, $etiqueta, $dura, $valo, $descrip, $compe, $dina, $img, $visibilidad)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO curso (nombre, etiqueta, duracion, valoracion, descripcion, competencias, dinamicas, imagen, visibilidad)
        VALUES ('$nombre', '$etiqueta', '$dura', '$valo', '$descrip', '$compe', '$dina', '$img', '$visibilidad')";

        $stmt = $conn->prepare($sql);
        //dd($stmt);
        $resultSet = $stmt->executeQuery();
        //dd($resultSet);

        return $resultSet->fetchAllAssociative();
    }

    public function editarCurso($id, $nombre, $etiqueta, $dura, $valo, $descrip, $compe, $dina, $img, $visibilidad)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE curso SET nombre = '$nombre', etiqueta = '$etiqueta', duracion = '$dura', valoracion = '$valo', descripcion = '$descrip',
        competencias = '$compe', dinamicas = '$dina', imagen = '$img', visibilidad = '$visibilidad'
        WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function borrarCurso($id)
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM curso WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    //    /**
    //     * @return Curso[] Returns an array of Curso objects
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

    //    public function findOneBySomeField($value): ?Curso
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
