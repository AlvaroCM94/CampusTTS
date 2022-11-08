<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private $etiqueta;

    #[ORM\Column(type: 'float', nullable:true)]
    private $duracion;

    #[ORM\Column(type: 'integer', nullable:true)]
    private $valoracion;

    #[ORM\Column(type: 'text', nullable:true)]
    private $descripcion;

    #[ORM\Column(type: 'text', nullable:true)]
    private $competencias;

    #[ORM\Column(type: 'text', nullable:true)]
    private $dinamicas;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: Objetivo::class, orphanRemoval: true)]
    private $objetivos;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: CompetenciaBasica::class, orphanRemoval: true)]
    private $competenciaBasicas;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: CompetenciaGenerales::class, orphanRemoval: true)]
    private $competenciaGenerales;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: CompetenciaEspecifica::class, orphanRemoval: true)]
    private $competenciaEspecificas;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: TablaContenidos::class, orphanRemoval: true)]
    private $tablaContenidos;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: Material::class, orphanRemoval: true)]
    private $materiales;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private $imagen;

    #[ORM\Column(type: 'boolean', nullable:true)]
    private $visibilidad;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: UsuarioCurso::class)]
    private $usuarioCursos;

    #[ORM\OneToMany(mappedBy: 'id_curso', targetEntity: Reserva::class)]
    private $reservas;

    public function __construct()
    {
        $this->objetivos = new ArrayCollection();
        $this->competenciaBasicas = new ArrayCollection();
        $this->competenciaGenerales = new ArrayCollection();
        $this->competenciaEspecificas = new ArrayCollection();
        $this->tablaContenidos = new ArrayCollection();
        $this->materiales = new ArrayCollection();
        $this->usuarioCursos = new ArrayCollection();
        $this->reservas = new ArrayCollection();
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

    public function getEtiqueta(): ?string
    {
        return $this->etiqueta;
    }

    public function setEtiqueta(string $etiqueta): self
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    public function getDuracion(): ?float
    {
        return $this->duracion;
    }

    public function setDuracion(float $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getValoracion(): ?int
    {
        return $this->valoracion;
    }

    public function setValoracion(int $valoracion): self
    {
        $this->valoracion = $valoracion;

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

    public function getCompetencias(): ?string
    {
        return $this->competencias;
    }

    public function setCompetencias(string $competencias): self
    {
        $this->competencias = $competencias;

        return $this;
    }

    public function getDinamicas(): ?string
    {
        return $this->dinamicas;
    }

    public function setDinamicas(string $dinamicas): self
    {
        $this->dinamicas = $dinamicas;

        return $this;
    }

    /**
     * @return Collection<int, Objetivo>
     */
    public function getObjetivos(): Collection
    {
        return $this->objetivos;
    }

    public function addObjetivo(Objetivo $objetivo): self
    {
        if (!$this->objetivos->contains($objetivo)) {
            $this->objetivos[] = $objetivo;
            $objetivo->setIdCurso($this);
        }

        return $this;
    }

    public function removeObjetivo(Objetivo $objetivo): self
    {
        if ($this->objetivos->removeElement($objetivo)) {
            // set the owning side to null (unless already changed)
            if ($objetivo->getIdCurso() === $this) {
                $objetivo->setIdCurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetenciaBasica>
     */
    public function getCompetenciaBasicas(): Collection
    {
        return $this->competenciaBasicas;
    }

    public function addCompetenciaBasica(CompetenciaBasica $competenciaBasica): self
    {
        if (!$this->competenciaBasicas->contains($competenciaBasica)) {
            $this->competenciaBasicas[] = $competenciaBasica;
            $competenciaBasica->setIdCurso($this);
        }

        return $this;
    }

    public function removeCompetenciaBasica(CompetenciaBasica $competenciaBasica): self
    {
        if ($this->competenciaBasicas->removeElement($competenciaBasica)) {
            // set the owning side to null (unless already changed)
            if ($competenciaBasica->getIdCurso() === $this) {
                $competenciaBasica->setIdCurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetenciaGenerales>
     */
    public function getCompetenciaGenerales(): Collection
    {
        return $this->competenciaGenerales;
    }

    public function addCompetenciaGenerale(CompetenciaGenerales $competenciaGenerale): self
    {
        if (!$this->competenciaGenerales->contains($competenciaGenerale)) {
            $this->competenciaGenerales[] = $competenciaGenerale;
            $competenciaGenerale->setIdCurso($this);
        }

        return $this;
    }

    public function removeCompetenciaGenerale(CompetenciaGenerales $competenciaGenerale): self
    {
        if ($this->competenciaGenerales->removeElement($competenciaGenerale)) {
            // set the owning side to null (unless already changed)
            if ($competenciaGenerale->getIdCurso() === $this) {
                $competenciaGenerale->setIdCurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetenciaEspecifica>
     */
    public function getCompetenciaEspecificas(): Collection
    {
        return $this->competenciaEspecificas;
    }

    public function addCompetenciaEspecifica(CompetenciaEspecifica $competenciaEspecifica): self
    {
        if (!$this->competenciaEspecificas->contains($competenciaEspecifica)) {
            $this->competenciaEspecificas[] = $competenciaEspecifica;
            $competenciaEspecifica->setIdCurso($this);
        }

        return $this;
    }

    public function removeCompetenciaEspecifica(CompetenciaEspecifica $competenciaEspecifica): self
    {
        if ($this->competenciaEspecificas->removeElement($competenciaEspecifica)) {
            // set the owning side to null (unless already changed)
            if ($competenciaEspecifica->getIdCurso() === $this) {
                $competenciaEspecifica->setIdCurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TablaContenidos>
     */
    public function getTablaContenidos(): Collection
    {
        return $this->tablaContenidos;
    }

    public function addTablaContenido(TablaContenidos $tablaContenido): self
    {
        if (!$this->tablaContenidos->contains($tablaContenido)) {
            $this->tablaContenidos[] = $tablaContenido;
            $tablaContenido->setIdCurso($this);
        }

        return $this;
    }

    public function removeTablaContenido(TablaContenidos $tablaContenido): self
    {
        if ($this->tablaContenidos->removeElement($tablaContenido)) {
            // set the owning side to null (unless already changed)
            if ($tablaContenido->getIdCurso() === $this) {
                $tablaContenido->setIdCurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Material>
     */
    public function getMateriales(): Collection
    {
        return $this->materiales;
    }

    public function addMateriale(Material $materiale): self
    {
        if (!$this->materiales->contains($materiale)) {
            $this->materiales[] = $materiale;
            $materiale->setIdCurso($this);
        }

        return $this;
    }

    public function removeMateriale(Material $materiale): self
    {
        if ($this->materiales->removeElement($materiale)) {
            // set the owning side to null (unless already changed)
            if ($materiale->getIdCurso() === $this) {
                $materiale->setIdCurso(null);
            }
        }

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

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
            $usuarioCurso->setIdCurso($this);
        }

        return $this;
    }

    public function removeUsuarioCurso(UsuarioCurso $usuarioCurso): self
    {
        if ($this->usuarioCursos->removeElement($usuarioCurso)) {
            // set the owning side to null (unless already changed)
            if ($usuarioCurso->getIdCurso() === $this) {
                $usuarioCurso->setIdCurso(null);
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
            $reserva->setIdCurso($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getIdCurso() === $this) {
                $reserva->setIdCurso(null);
            }
        }

        return $this;
    }

}
