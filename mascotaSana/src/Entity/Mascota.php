<?php

namespace App\Entity;

use App\Repository\MascotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MascotaRepository::class)]
class Mascota
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'mascotas')]
    private ?Raza $raza = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_nac = null;

    #[ORM\ManyToOne(inversedBy: 'mascotas')]
    private ?Tipo $tipo = null;

    #[ORM\ManyToOne(inversedBy: 'mascotas')]
    private ?Propietario $propietario = null;

    #[ORM\OneToMany(mappedBy: 'mascota', targetEntity: Consulta::class)]
    private Collection $consultas;

    public function __construct()
    {
        $this->consultas = new ArrayCollection();
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getRaza(): ?Raza
    {
        return $this->raza;
    }

    public function setRaza(?Raza $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getFechaNac(): ?\DateTimeInterface
    {
        return $this->fecha_nac;
    }

    public function setFechaNac(?\DateTimeInterface $fecha_nac): static
    {
        $this->fecha_nac = $fecha_nac;

        return $this;
    }

    public function getTipo(): ?Tipo
    {
        return $this->tipo;
    }

    public function setTipo(?Tipo $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getPropietario(): ?Propietario
    {
        return $this->propietario;
    }

    public function setPropietario(?Propietario $propietario): static
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * @return Collection<int, Consulta>
     */
    public function getConsultas(): Collection
    {
        return $this->consultas;
    }

    public function addConsulta(Consulta $consulta): static
    {
        if (!$this->consultas->contains($consulta)) {
            $this->consultas->add($consulta);
            $consulta->setMascota($this);
        }

        return $this;
    }

    public function removeConsulta(Consulta $consulta): static
    {
        if ($this->consultas->removeElement($consulta)) {
            // set the owning side to null (unless already changed)
            if ($consulta->getMascota() === $this) {
                $consulta->setMascota(null);
            }
        }

        return $this;
    }
}
