<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nick;


    /**
     * @ORM\Column(type="integer")
     */
    private $telefono;

    /**
     * @ORM\OneToMany(targetEntity=Partida::class, mappedBy="usuario")
     */
    private $partidas;

    /**
     * @ORM\OneToMany(targetEntity=Articulo::class, mappedBy="usuario")
     */
    private $articulosCreados;

    /**
     * @ORM\OneToMany(targetEntity=Califica::class, mappedBy="usuario")
     */
    private $calificas;

    /**
     * @ORM\OneToMany(targetEntity=Publicacion::class, mappedBy="usuario")
     */
    private $publicacions;

    /**
     * @ORM\OneToMany(targetEntity=Oferta::class, mappedBy="usuario")
     */
    private $ofertas;

    /**
     * @ORM\OneToMany(targetEntity=Interactua::class, mappedBy="usuario")
     */
    private $interactuas;



    public function __construct()
    {
        $this->partidas = new ArrayCollection();
        $this->articulosCreados = new ArrayCollection();
        $this->calificados = new ArrayCollection();
        $this->calificas = new ArrayCollection();
        $this->publicacions = new ArrayCollection();
        $this->ofertas = new ArrayCollection();
        $this->interactuas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

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

    /**
     * @return Collection<int, Partida>
     */
    public function getPartidas(): Collection
    {
        return $this->partidas;
    }

    public function addPartida(Partida $partida): self
    {
        if (!$this->partidas->contains($partida)) {
            $this->partidas[] = $partida;
            $partida->setUsuario($this);
        }

        return $this;
    }

    public function removePartida(Partida $partida): self
    {
        if ($this->partidas->removeElement($partida)) {
            // set the owning side to null (unless already changed)
            if ($partida->getUsuario() === $this) {
                $partida->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Articulo>
     */
    public function getArticulosCreados(): Collection
    {
        return $this->articulosCreados;
    }

    public function addArticulosCreado(Articulo $articulosCreado): self
    {
        if (!$this->articulosCreados->contains($articulosCreado)) {
            $this->articulosCreados[] = $articulosCreado;
            $articulosCreado->setUsuario($this);
        }

        return $this;
    }

    public function removeArticulosCreado(Articulo $articulosCreado): self
    {
        if ($this->articulosCreados->removeElement($articulosCreado)) {
            // set the owning side to null (unless already changed)
            if ($articulosCreado->getUsuario() === $this) {
                $articulosCreado->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Califica>
     */
    public function getCalificas(): Collection
    {
        return $this->calificas;
    }

    public function addCalifica(Califica $califica): self
    {
        if (!$this->calificas->contains($califica)) {
            $this->calificas[] = $califica;
            $califica->setUsuario($this);
        }

        return $this;
    }

    public function removeCalifica(Califica $califica): self
    {
        if ($this->calificas->removeElement($califica)) {
            // set the owning side to null (unless already changed)
            if ($califica->getUsuario() === $this) {
                $califica->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Publicacion>
     */
    public function getPublicacions(): Collection
    {
        return $this->publicacions;
    }

    public function addPublicacion(Publicacion $publicacion): self
    {
        if (!$this->publicacions->contains($publicacion)) {
            $this->publicacions[] = $publicacion;
            $publicacion->setUsuario($this);
        }

        return $this;
    }

    public function removePublicacion(Publicacion $publicacion): self
    {
        if ($this->publicacions->removeElement($publicacion)) {
            // set the owning side to null (unless already changed)
            if ($publicacion->getUsuario() === $this) {
                $publicacion->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Oferta>
     */
    public function getOfertas(): Collection
    {
        return $this->ofertas;
    }

    public function addOferta(Oferta $oferta): self
    {
        if (!$this->ofertas->contains($oferta)) {
            $this->ofertas[] = $oferta;
            $oferta->setUsuario($this);
        }

        return $this;
    }

    public function removeOferta(Oferta $oferta): self
    {
        if ($this->ofertas->removeElement($oferta)) {
            // set the owning side to null (unless already changed)
            if ($oferta->getUsuario() === $this) {
                $oferta->setUsuario(null);
            }
        }

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
            $interactua->setUsuario($this);
        }

        return $this;
    }

    public function removeInteractua(Interactua $interactua): self
    {
        if ($this->interactuas->removeElement($interactua)) {
            // set the owning side to null (unless already changed)
            if ($interactua->getUsuario() === $this) {
                $interactua->setUsuario(null);
            }
        }

        return $this;
    }


}
