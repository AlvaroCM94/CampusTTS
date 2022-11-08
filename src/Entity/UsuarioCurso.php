<?php

namespace App\Entity;

use App\Repository\UsuarioCursoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioCursoRepository::class)]
class UsuarioCurso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'usuarioCursos')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_usuario;

    #[ORM\ManyToOne(targetEntity: Curso::class, inversedBy: 'usuarioCursos')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_curso;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
