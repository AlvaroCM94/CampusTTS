<?php

namespace App\Entity;

use App\Repository\CompetenciaBasicaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenciaBasicaRepository::class)]
class CompetenciaBasica
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $descripcion;

    #[ORM\ManyToOne(targetEntity: Curso::class, inversedBy: 'competenciaBasicas')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_curso;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
}
