<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristicaTraduccionRepository")
 */
class CaracteristicaTraduccion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Caracteristica", inversedBy="caracteristicaTraduccions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $caracteristica;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): self
    {
        $this->idioma = $idioma;

        return $this;
    }

    public function getCaracteristica(): ?Caracteristica
    {
        return $this->caracteristica;
    }

    public function setCaracteristica(?Caracteristica $caracteristica): self
    {
        $this->caracteristica = $caracteristica;

        return $this;
    }
}
