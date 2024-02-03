<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoRepository::class)]
class Tipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'tipo', targetEntity: Mascota::class)]
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
            $mascota->setTipo($this);
        }

        return $this;
    }

    public function removeMascota(Mascota $mascota): static
    {
        if ($this->mascotas->removeElement($mascota)) {
            // set the owning side to null (unless already changed)
            if ($mascota->getTipo() === $this) {
                $mascota->setTipo(null);
            }
        }

        return $this;
    }
}
