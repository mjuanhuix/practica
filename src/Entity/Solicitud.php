<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudRepository")
 * @ORM\Entity(repositoryClass="App\Repository\AplicacionRepository")
 */
class Solicitud
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="solicituds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aplicacion", inversedBy="solicituds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aplicacion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Caracteristica", inversedBy="solicituds")
     */
    private $caracteristica;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Proyecto", mappedBy="solicitud", cascade={"persist", "remove"})
     */
    private $proyecto;




    public function __construct()
    {
        $this->caracteristica = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }


    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

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
     * @return Collection|Caracteristica[]
     */
    public function getCaracteristica(): Collection
    {
        return $this->caracteristica;
    }

    public function addCaracteristica(Caracteristica $caracteristica): self
    {
        if (!$this->caracteristica->contains($caracteristica)) {
            $this->caracteristica[] = $caracteristica;
        }

        return $this;
    }

    public function removeCaracteristica(Caracteristica $caracteristica): self
    {
        if ($this->caracteristica->contains($caracteristica)) {
            $this->caracteristica->removeElement($caracteristica);
        }

        return $this;
    }

    public function getProyecto(): ?Proyecto
    {
        return $this->proyecto;
    }

    public function setProyecto(Proyecto $proyecto): self
    {
        $this->proyecto = $proyecto;

        // set the owning side of the relation if necessary
        if ($this !== $proyecto->getSolicitud()) {
            $proyecto->setSolicitud($this);
        }

        return $this;
    }

}
