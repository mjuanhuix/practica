<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProyectoRepository")
 */
class Proyecto
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
    private $presupuestoFinal;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaEntrega;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $estado;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Solicitud", inversedBy="proyecto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $solicitud;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tarea", mappedBy="proyecto")
     */
    private $tareas;

    public function __construct()
    {
        $this->tareas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresupuestoFinal(): ?float
    {
        return $this->presupuestoFinal;
    }

    public function setPresupuestoFinal(float $presupuestoFinal): self
    {
        $this->presupuestoFinal = $presupuestoFinal;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

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

    public function getSolicitud(): ?Solicitud
    {
        return $this->solicitud;
    }

    public function setSolicitud(Solicitud $solicitud): self
    {
        $this->solicitud = $solicitud;

        return $this;
    }

    /**
     * @return Collection|Tarea[]
     */
    public function getTareas(): Collection
    {
        return $this->tareas;
    }

    public function addTarea(Tarea $tarea): self
    {
        if (!$this->tareas->contains($tarea)) {
            $this->tareas[] = $tarea;
            $tarea->setProyecto($this);
        }

        return $this;
    }

    public function removeTarea(Tarea $tarea): self
    {
        if ($this->tareas->contains($tarea)) {
            $this->tareas->removeElement($tarea);
            // set the owning side to null (unless already changed)
            if ($tarea->getProyecto() === $this) {
                $tarea->setProyecto(null);
            }
        }

        return $this;
    }
}
