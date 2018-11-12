<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AplicacionRepository")
 */
class Aplicacion
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
     * @ORM\OneToMany(targetEntity="App\Entity\Solicitud", mappedBy="aplicacion", orphanRemoval=true)
     */
    private $solicituds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Caracteristica", mappedBy="aplicacion", orphanRemoval=true)
     */
    private $caracteristicas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AplicacionTraduccion", mappedBy="aplicacion", orphanRemoval=true)
     */
    private $aplicacionTraduccions;

    public function __construct()
    {
        $this->solicituds = new ArrayCollection();
        $this->caracteristicas = new ArrayCollection();
        $this->aplicacionTraduccions = new ArrayCollection();
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
            $solicitud->setAplicacion($this);
        }
        return $this;
    }

    public function removeSolicitud(Solicitud $solicitud): self
    {
        if ($this->solicituds->contains($solicitud)) {
            $this->solicituds->removeElement($solicitud);
            // set the owning side to null (unless already changed)
            if ($solicitud->getAplicacion() === $this) {
                $solicitud->setAplicacion(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Caracteristica[]
     */
    public function getCaracteristicas(): Collection
    {
        return $this->caracteristicas;
    }

    public function addCaracteristica(Caracteristica $caracteristica): self
    {
        if (!$this->caracteristicas->contains($caracteristica)) {
            $this->caracteristicas[] = $caracteristica;
            $caracteristica->setAplicacion($this);
        }
        return $this;
    }

    public function removeCaracteristica(Caracteristica $caracteristica): self
    {
        if ($this->caracteristicas->contains($caracteristica)) {
            $this->caracteristicas->removeElement($caracteristica);
            // set the owning side to null (unless already changed)
            if ($caracteristica->getAplicacion() === $this) {
                $caracteristica->setAplicacion(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|AplicacionTraduccion[]
     */
    public function getAplicacionTraduccions(): Collection
    {
        return $this->aplicacionTraduccions;
    }

    public function addAplicacionTraduccion(AplicacionTraduccion $aplicacionTraduccion): self
    {
        if (!$this->aplicacionTraduccions->contains($aplicacionTraduccion)) {
            $this->aplicacionTraduccions[] = $aplicacionTraduccion;
            $aplicacionTraduccion->setAplicacion($this);
        }
        return $this;
    }

    public function removeAplicacionTraduccion(AplicacionTraduccion $aplicacionTraduccion): self
    {
        if ($this->aplicacionTraduccions->contains($aplicacionTraduccion)) {
            $this->aplicacionTraduccions->removeElement($aplicacionTraduccion);
            // set the owning side to null (unless already changed)
            if ($aplicacionTraduccion->getAplicacion() === $this) {
                $aplicacionTraduccion->setAplicacion(null);
            }
        }
        return $this;
    }

}