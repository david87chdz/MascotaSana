<?php

namespace App\Entity;

use App\Repository\PropietarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropietarioRepository::class)]
class Propietario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombre = null;

    #[ORM\Column(length: 40)]
    private ?string $direccion = null;

    #[ORM\Column(length: 15)]
    private ?string $telefono = null;

    #[ORM\OneToMany(mappedBy: 'propietario', targetEntity: Mascota::class)]
    private Collection $mascotas;

    public function __construct()
    {
        $this->mascotas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @return Collection<int, Mascota>
     */
    public function getMascotas(): Collection
    {
        return $this->mascotas;
    }

    public function addMascota(Mascota $mascota): static
    {
        if (!$this->mascotas->contains($mascota)) {
            $this->mascotas->add($mascota);
            $mascota->setPropietario($this);
        }

        return $this;
    }

    public function removeMascota(Mascota $mascota): static
    {
        if ($this->mascotas->removeElement($mascota)) {
            // set the owning side to null (unless already changed)
            if ($mascota->getPropietario() === $this) {
                $mascota->setPropietario(null);
            }
        }

        return $this;
    }
}
