<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true, nullable:true)]
    private $nombre;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $email;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: UsuarioCurso::class)]
    private $usuarioCursos;

    #[ORM\OneToMany(mappedBy: 'instructor', targetEntity: InstructorUsuario::class)]
    private $instructor;

    #[ORM\OneToMany(mappedBy: 'alumno', targetEntity: InstructorUsuario::class)]
    private $alumno;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: Reserva::class)]
    private $reservas;

    #[ORM\OneToOne(mappedBy: 'id_alumno', targetEntity: Chat::class)]
    private $chat_alumno;

    #[ORM\OneToMany(mappedBy: 'id_instructor', targetEntity: Chat::class)]
    private $chat_instructor;

    /*#[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $apellidos;*/

    #[ORM\Column(type: 'string', nullable: true)]
    private $dni;

    /*#[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $genero;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nivel_estudios;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $area_titulo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $empresa;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cargo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $alma_mater;
*/
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $areas_interes;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $telefono;
/*
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $como_conoce;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipo_contacto;
    */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private $comunicaciones;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $procesar_almacenar_datos;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $tramitado;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $info_inscripcion;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genero = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $jerarquia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $funcional = null;

    public function __construct()
    {
        $this->usuarioCursos = new ArrayCollection();
        $this->instructor = new ArrayCollection();
        $this->alumno = new ArrayCollection();
        $this->reservas = new ArrayCollection();
        $this->chat_instructor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->nombre;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->nombre;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';
            
        // $roles = [
        //     'ROLE_USER' => 'ROLE_USER',
        //     'ROLE_ADMIN' => 'ROLE_ADMIN'
        // ];

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self{
        
        $this->password = $password;
        //$this->password = $this->setPasswordEncoded($password);

        return $this;
    }

    public function setPasswordEncoded(string $password, UserPasswordHasherInterface $passwordHasher){
        $user = new Usuario();

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id . " - " . $this->nombre;
    }

    /**
     * @return Collection<int, UsuarioCurso>
     */
    public function getUsuarioCursos(): Collection
    {
        return $this->usuarioCursos;
    }

    public function addUsuarioCurso(UsuarioCurso $usuarioCurso): self
    {
        if (!$this->usuarioCursos->contains($usuarioCurso)) {
            $this->usuarioCursos[] = $usuarioCurso;
            $usuarioCurso->setIdUsuario($this);
        }

        return $this;
    }

    public function removeUsuarioCurso(UsuarioCurso $usuarioCurso): self
    {
        if ($this->usuarioCursos->removeElement($usuarioCurso)) {
            // set the owning side to null (unless already changed)
            if ($usuarioCurso->getIdUsuario() === $this) {
                $usuarioCurso->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstructorUsuario>
     */
    public function getInstructor(): Collection
    {
        return $this->instructor;
    }

    public function addInstructor(InstructorUsuario $instructor): self
    {
        if (!$this->instructor->contains($instructor)) {
            $this->instructor[] = $instructor;
            $instructor->setInstructor($this);
        }

        return $this;
    }

    public function removeInstructor(InstructorUsuario $instructor): self
    {
        if ($this->instructor->removeElement($instructor)) {
            // set the owning side to null (unless already changed)
            if ($instructor->getInstructor() === $this) {
                $instructor->setInstructor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstructorUsuario>
     */
    public function getAlumno(): Collection
    {
        return $this->alumno;
    }

    public function addAlumno(InstructorUsuario $alumno): self
    {
        if (!$this->alumno->contains($alumno)) {
            $this->alumno[] = $alumno;
            $alumno->setAlumno($this);
        }

        return $this;
    }

    public function removeAlumno(InstructorUsuario $alumno): self
    {
        if ($this->alumno->removeElement($alumno)) {
            // set the owning side to null (unless already changed)
            if ($alumno->getAlumno() === $this) {
                $alumno->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setIdUsuario($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getIdUsuario() === $this) {
                $reserva->setIdUsuario(null);
            }
        }

        return $this;
    }

    public function getChatAlumno(): ?Chat
    {
        return $this->chat_alumno;
    }

    public function setChatAlumno(Chat $chat_alumno): self
    {
        // set the owning side of the relation if necessary
        if ($chat_alumno->getIdAlumno() !== $this) {
            $chat_alumno->setIdAlumno($this);
        }

        $this->chat_alumno = $chat_alumno;

        return $this;
    }

    /**
     * @return Collection<int, Chat>
     */
    public function getChatInstructor(): Collection
    {
        return $this->chat_instructor;
    }

    public function addChatInstructor(Chat $chatInstructor): self
    {
        if (!$this->chat_instructor->contains($chatInstructor)) {
            $this->chat_instructor[] = $chatInstructor;
            $chatInstructor->setIdInstructor($this);
        }

        return $this;
    }

    public function removeChatInstructor(Chat $chatInstructor): self
    {
        if ($this->chat_instructor->removeElement($chatInstructor)) {
            // set the owning side to null (unless already changed)
            if ($chatInstructor->getIdInstructor() === $this) {
                $chatInstructor->setIdInstructor(null);
            }
        }

        return $this;
    }

    /*public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }*/

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    /*public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getNivelEstudios(): ?string
    {
        return $this->nivel_estudios;
    }

    public function setNivelEstudios(?string $nivel_estudios): self
    {
        $this->nivel_estudios = $nivel_estudios;

        return $this;
    }

    public function getAreaTitulo(): ?string
    {
        return $this->area_titulo;
    }

    public function setAreaTitulo(?string $area_titulo): self
    {
        $this->area_titulo = $area_titulo;

        return $this;
    }

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function setEmpresa(?string $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getAlmaMater(): ?string
    {
        return $this->alma_mater;
    }

    public function setAlmaMater(?string $alma_mater): self
    {
        $this->alma_mater = $alma_mater;

        return $this;
    }
*/
    public function getAreasInteres(): ?string
    {
        return $this->areas_interes;
    }

    public function setAreasInteres(?string $areas_interes): self
    {
        $this->areas_interes = $areas_interes;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(?int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }
/*
    public function getComoConoce(): ?string
    {
        return $this->como_conoce;
    }

    public function setComoConoce(?string $como_conoce): self
    {
        $this->como_conoce = $como_conoce;

        return $this;
    }

    public function getTipoContacto(): ?string
    {
        return $this->tipo_contacto;
    }

    public function setTipoContacto(?string $tipo_contacto): self
    {
        $this->tipo_contacto = $tipo_contacto;

        return $this;
    }*/

    public function isComunicaciones(): ?bool
    {
        return $this->comunicaciones;
    }

    public function setComunicaciones(?bool $comunicaciones): self
    {
        $this->comunicaciones = $comunicaciones;

        return $this;
    }

    public function isProcesarAlmacenarDatos(): ?bool
    {
        return $this->procesar_almacenar_datos;
    }

    public function setProcesarAlmacenarDatos(?bool $procesar_almacenar_datos): self
    {
        $this->procesar_almacenar_datos = $procesar_almacenar_datos;

        return $this;
    }

    public function isTramitado(): ?bool
    {
        return $this->tramitado;
    }

    public function setTramitado(?bool $tramitado): self
    {
        $this->tramitado = $tramitado;

        return $this;
    }

    public function getInfoInscripcion(): ?string
    {
        return $this->info_inscripcion;
    }

    public function setInfoInscripcion(?string $info_inscripcion): self
    {
        $this->info_inscripcion = $info_inscripcion;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getJerarquia(): ?string
    {
        return $this->jerarquia;
    }

    public function setJerarquia(?string $jerarquia): self
    {
        $this->jerarquia = $jerarquia;

        return $this;
    }

    public function getFuncional(): ?string
    {
        return $this->funcional;
    }

    public function setFuncional(?string $funcional): self
    {
        $this->funcional = $funcional;

        return $this;
    }

}
