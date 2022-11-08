<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'chat_alumno', targetEntity: Usuario::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $id_alumno;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'chat_instructor')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_instructor;

    #[ORM\Column(type: 'array', nullable: true)]
    private $mensajes = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAlumno(): ?Usuario
    {
        return $this->id_alumno;
    }

    public function setIdAlumno(Usuario $id_alumno): self
    {
        $this->id_alumno = $id_alumno;

        return $this;
    }

    public function getIdInstructor(): ?Usuario
    {
        return $this->id_instructor;
    }

    public function setIdInstructor(?Usuario $id_instructor): self
    {
        $this->id_instructor = $id_instructor;

        return $this;
    }

    public function getMensajes(): ?array
    {
        return $this->mensajes;
    }

    public function setMensajes(?array $mensajes): self
    {
        $this->mensajes = $mensajes;

        return $this;
    }
}
