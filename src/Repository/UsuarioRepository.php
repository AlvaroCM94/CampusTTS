<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<Usuario>
 *
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    public function add(Usuario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Usuario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Usuario) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

    public function usuarios()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM usuario";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function altaUsuario($rol, $cifrada, $email)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO usuario (roles, password, email)
        VALUES ('$rol', '$cifrada', '$email')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function cambioContraUsuario($cifrada, $email)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE usuario SET password = '$cifrada' WHERE email = '$email'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getUsuarioPorEmail($email)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT id FROM usuario WHERE email='$email'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAlumnosPorId($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM usuario WHERE id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getReservasAlumnosPorId($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM reserva WHERE id_usuario_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function modificarEstado($idAlumno, $idCurso, $estado){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE usuario_curso SET estado = '$estado' WHERE id_usuario_id = '$idAlumno' AND id_curso_id = '$idCurso'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function contactoForm($nombreApe, $rol, $password, $correo, $comunicaciones, $datos, $tipoInfo, $interes, $telefono, $dni, $genero, $jerarquia, $funcional){

        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO usuario (nombre, roles, password, email, comunicaciones, procesar_almacenar_datos, tramitado, info_inscripcion, areas_interes, telefono, dni, genero, jerarquia, funcional)
        VALUES ('$nombreApe', '$rol', '$password', '$correo', '$comunicaciones', '$datos', '0', '$tipoInfo', '$interes', '$telefono', '$dni', '$genero', '$jerarquia', '$funcional')";

        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function crearUsuario($nombre, $rol, $cifrada, $email, $comunicaciones, $datos, $tramitado, $tlf, $dni){

        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO usuario (nombre, roles, password, email, comunicaciones, procesar_almacenar_datos, tramitado, telefono, dni)
        VALUES ('$nombre', '$rol', '$cifrada', '$email', '$comunicaciones', '$datos', '$tramitado', '$tlf', '$dni')";

        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function actualizarConPass($id, $nombre, $password, $email, $comunicaciones, $procesar_almacenar_datos, $tramitado, $tlf, $dni){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE usuario SET nombre = '$nombre', password = '$password', email = '$email', comunicaciones = '$comunicaciones', 
                procesar_almacenar_datos = '$procesar_almacenar_datos', tramitado = '$tramitado', telefono = '$tlf', dni = '$dni' 
                WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function actualizarSinPass($id, $nombre, $email, $comunicaciones, $procesar_almacenar_datos, $tramitado, $tlf, $dni){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE usuario SET nombre = '$nombre', email = '$email', comunicaciones = '$comunicaciones', 
                procesar_almacenar_datos = '$procesar_almacenar_datos', tramitado = '$tramitado', telefono = '$tlf', dni = '$dni' 
                WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function borrarUser($id){

        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM usuario WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }


    //    /**
    //     * @return Usuario[] Returns an array of Usuario objects
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

    //    public function findOneBySomeField($value): ?Usuario
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
