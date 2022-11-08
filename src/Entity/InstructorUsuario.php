<?php

namespace App\Entity;

use App\Repository\InstructorUsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstructorUsuarioRepository::class)]
class InstructorUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'instructor')]
    #[ORM\JoinColumn(nullable: false)]
    private $instructor;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'alumno')]
    #[ORM\JoinColumn(nullable: false)]
    private $alumno;

    #[ORM\Column(type: 'boolean')]
    private $activo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstructor(): ?Usuario
    {
        return $this->instructor;
    }

    public function setInstructor(?Usuario $instructor): self
    {
        $this->instructor = $instructor;

        return $this;
    }

    public function getAlumno(): ?Usuario
    {
        return $this->alumno;
    }

    public function setAlumno(?Usuario $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
}
