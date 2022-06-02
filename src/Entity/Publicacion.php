<?php

namespace App\Entity;

use App\Repository\PublicacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublicacionRepository::class)
 */
class Publicacion
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
    private $foto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="publicacions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity=Interactua::class, mappedBy="publicacion")
     */
    private $interactuas;

    public function __construct()
    {
        $this->interactuas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
     * @return Collection<int, Interactua>
     */
    public function getInteractuas(): Collection
    {
        return $this->interactuas;
    }

    public function addInteractua(Interactua $interactua): self
    {
        if (!$this->interactuas->contains($interactua)) {
            $this->interactuas[] = $interactua;
            $interactua->setPublicacion($this);
        }

        return $this;
    }

    public function removeInteractua(Interactua $interactua): self
    {
        if ($this->interactuas->removeElement($interactua)) {
            // set the owning side to null (unless already changed)
            if ($interactua->getPublicacion() === $this) {
                $interactua->setPublicacion(null);
            }
        }

        return $this;
    }
}
