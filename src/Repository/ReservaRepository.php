<?php

namespace App\Repository;

use App\Entity\Reserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reserva>
 *
 * @method Reserva|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserva|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserva[]    findAll()
 * @method Reserva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserva::class);
    }

    public function add(Reserva $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reserva $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function addReserva($idUsuario, $reserva, $idLugar, $idCurso, $tipo){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO reserva (id_usuario_id, id_curso_id, lugar_id, fecha, tipo)
        VALUES ('$idUsuario', '$idCurso', '$idLugar', '$reserva', '$tipo')";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllReservasPorId($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT fecha FROM reserva WHERE id_usuario_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllIdLugaresPorIdUser($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT lugar_id FROM reserva WHERE id_usuario_id='$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllReservas(){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM reserva";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getAllReservasOrdenadas(){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM reserva ORDER BY fecha ASC";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function updateReserva($id, $reserva){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE reserva SET fecha = '$reserva' WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function deleteReserva($id){

        $conn = $this->getEntityManager()->getConnection();

        $sql = "DELETE FROM reserva WHERE id = '$id'";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

//    /**
//     * @return Reserva[] Returns an array of Reserva objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reserva
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
