<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AplicacionTraduccionRepository")
 */
class AplicacionTraduccion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aplicacion", inversedBy="aplicacionTraduccions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aplicacion;

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

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): self
    {
        $this->idioma = $idioma;

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
}
