<?php

namespace App\Entity;

use App\Repository\CalificaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalificaRepository::class)
 */
class Califica
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $puntuacion;


    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="calificas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Articulo::class, inversedBy="calificadoPor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articulo;

    public function getId(): ?int
    {
        return $this->id;
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


    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getArticulo(): ?Articulo
    {
        return $this->articulo;
    }

    public function setArticulo(?Articulo $articulo): self
    {
        $this->articulo = $articulo;

        return $this;
    }
}
