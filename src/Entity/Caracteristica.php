<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristicaRepository")
 */
class Caracteristica
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aplicacion", inversedBy="caracteristicas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aplicacion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Solicitud", mappedBy="caracteristica")
     */
    private $solicituds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CaracteristicaTraduccion", mappedBy="caracteristica", orphanRemoval=true)
     */
    private $caracteristicaTraduccions;

    public function __construct()
    {
        $this->solicituds = new ArrayCollection();
        $this->caracteristicaTraduccions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getAplicacion(): ?Aplicacion
    {
        return $this->aplicacion;
    }

    public function setAplicacion(?Aplicacion $aplicacion): self
    {
        $this->aplicacion = $aplicacion;

        return $this;
    }

    /**
     * @return Collection|Solicitud[]
     */
    public function getSolicituds(): Collection
    {
        return $this->solicituds;
    }

    public function addSolicitud(Solicitud $solicitud): self
    {
        if (!$this->solicituds->contains($solicitud)) {
            $this->solicituds[] = $solicitud;
            $solicitud->addCaracteristica($this);
        }

        return $this;
    }

    public function removeSolicitud(Solicitud $solicitud): self
    {
        if ($this->solicituds->contains($solicitud)) {
            $this->solicituds->removeElement($solicitud);
            $solicitud->removeCaracteristica($this);
        }

        return $this;
    }

    /**
     * @return Collection|CaracteristicaTraduccion[]
     */
    public function getCaracteristicaTraduccions(): Collection
    {
        return $this->caracteristicaTraduccions;
    }

    public function addCaracteristicaTraduccion(CaracteristicaTraduccion $caracteristicaTraduccion): self
    {
        if (!$this->caracteristicaTraduccions->contains($caracteristicaTraduccion)) {
            $this->caracteristicaTraduccions[] = $caracteristicaTraduccion;
            $caracteristicaTraduccion->setCaracteristica($this);
        }

        return $this;
    }

    public function removeCaracteristicaTraduccion(CaracteristicaTraduccion $caracteristicaTraduccion): self
    {
        if ($this->caracteristicaTraduccions->contains($caracteristicaTraduccion)) {
            $this->caracteristicaTraduccions->removeElement($caracteristicaTraduccion);
            // set the owning side to null (unless already changed)
            if ($caracteristicaTraduccion->getCaracteristica() === $this) {
                $caracteristicaTraduccion->setCaracteristica(null);
            }
        }

        return $this;
    }
}
