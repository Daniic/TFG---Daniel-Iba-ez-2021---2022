<?php

namespace App\Entity;

use App\Repository\ArticuloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticuloRepository::class)
 */
class Articulo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="articulosCreados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity=Califica::class, mappedBy="articulo")
     */
    private $calificadoPor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo;

    /**
     * @ORM\Column(type="integer")
     */
    private $puntuacion;



    public function __construct()
    {
        $this->califica = new ArrayCollection();
        $this->calificadoPor = new ArrayCollection();
    }

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

    public function getSubtitulo(): ?string
    {
        return $this->subtitulo;
    }

    public function setSubtitulo(string $subtitulo): self
    {
        $this->subtitulo = $subtitulo;

        return $this;
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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, Califica>
     */
    public function getCalificadoPor(): Collection
    {
        return $this->calificadoPor;
    }

    public function addCalificadoPor(Califica $calificadoPor): self
    {
        if (!$this->calificadoPor->contains($calificadoPor)) {
            $this->calificadoPor[] = $calificadoPor;
            $calificadoPor->setArticulo($this);
        }

        return $this;
    }

    public function removeCalificadoPor(Califica $calificadoPor): self
    {
        if ($this->calificadoPor->removeElement($calificadoPor)) {
            // set the owning side to null (unless already changed)
            if ($calificadoPor->getArticulo() === $this) {
                $calificadoPor->setArticulo(null);
            }
        }

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getPuntuacion(): ?int
    {
        return $this->puntuacion;
    }

    public function setPuntuacion(int $puntuacion): self
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

}
