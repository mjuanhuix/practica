<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TareaRepository")
 */
class Tarea
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcionCorta;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcionLarga;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $estado;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proyecto", inversedBy="tareas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proyecto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="tareas")
     */
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcionCorta(): ?string
    {
        return $this->descripcionCorta;
    }

    public function setDescripcionCorta(string $descripcionCorta): self
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    public function getDescripcionLarga(): ?string
    {
        return $this->descripcionLarga;
    }

    public function setDescripcionLarga(?string $descripcionLarga): self
    {
        $this->descripcionLarga = $descripcionLarga;

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


    public function getProyecto(): ?Proyecto
    {
        return $this->proyecto;
    }

    public function setProyecto(?Proyecto $proyecto): self
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
