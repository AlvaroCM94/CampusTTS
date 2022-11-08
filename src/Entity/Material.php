<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private $enlace;

    #[ORM\ManyToOne(targetEntity: Curso::class, inversedBy: 'materiales')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_curso;

    #[ORM\Column(type: 'string', length: 255)]
    private $tema;

    #[ORM\Column(type: 'text')]
    private $descripcion;

    #[ORM\Column(type: 'boolean')]
    private $visibilidad;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getEnlace(): ?string
    {
        return $this->enlace;
    }

    public function setEnlace(string $enlace): self
    {
        $this->enlace = $enlace;

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

    public function getTema(): ?string
    {
        return $this->tema;
    }

    public function setTema(string $tema): self
    {
        $this->tema = $tema;

        return $this;
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

    public function isVisibilidad(): ?bool
    {
        return $this->visibilidad;
    }

    public function setVisibilidad(bool $visibilidad): self
    {
        $this->visibilidad = $visibilidad;

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
