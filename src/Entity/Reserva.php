<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', unique: true)]
    private $fecha;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_usuario;

    #[ORM\ManyToOne(targetEntity: Curso::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_curso;

    #[ORM\ManyToOne(targetEntity: Lugares::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $lugar;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?Usuario $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getIdCurso(): ?Curso
    {
        return $this->id_curso;
    }

    public function setIdCurso(?Curso $id_curso): self
    {
        $this->id_curso = $id_curso;

        return $this;
    }

    public function getLugar(): ?Lugares
    {
        return $this->lugar;
    }

    public function setLugar(?Lugares $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}
