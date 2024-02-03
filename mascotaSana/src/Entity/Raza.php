<?php

namespace App\Entity;

use App\Repository\RazaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RazaRepository::class)]
class Raza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(length: 15)]
    private ?string $tamanio = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $origen = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'raza', targetEntity: Mascota::class)]
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

    public function getTamanio(): ?string
    {
        return $this->tamanio;
    }

    public function setTamanio(string $tamanio): static
    {
        $this->tamanio = $tamanio;

        return $this;
    }

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(?string $origen): static
    {
        $this->origen = $origen;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

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
            $mascota->setRaza($this);
        }

        return $this;
    }

    public function removeMascota(Mascota $mascota): static
    {
        if ($this->mascotas->removeElement($mascota)) {
            // set the owning side to null (unless already changed)
            if ($mascota->getRaza() === $this) {
                $mascota->setRaza(null);
            }
        }

        return $this;
    }
}
