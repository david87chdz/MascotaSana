<?php

namespace App\Entity;

use App\Repository\ConsultaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultaRepository::class)]
class Consulta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'consultas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mascota $mascota = null;

    #[ORM\ManyToOne(inversedBy: 'consultas')]
    private ?Tratamiento $tratamiento = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $observaciones = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMascota(): ?Mascota
    {
        return $this->mascota;
    }

    public function setMascota(?Mascota $mascota): static
    {
        $this->mascota = $mascota;

        return $this;
    }

    public function getTratamiento(): ?Tratamiento
    {
        return $this->tratamiento;
    }

    public function setTratamiento(?Tratamiento $tratamiento): static
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): static
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
