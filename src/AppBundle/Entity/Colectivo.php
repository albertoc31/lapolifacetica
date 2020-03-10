<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colectivo
 *
 * @ORM\Table(name="colectivo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ColectivoRepository")
 */
class Colectivo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="asociacion", type="integer", nullable=true)
     */
    private $asociacion;

    /**
     * One colectivo has many programas. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Programa", mappedBy="colectivo")
     */
    private $programas;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Colectivo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Programa
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set asociacion
     *
     * @param integer $asociacion
     *
     * @return Colectivo
     */
    public function setAsociacion($asociacion)
    {
        $this->asociacion = $asociacion;

        return $this;
    }

    /**
     * Get asociacion
     *
     * @return int
     */
    public function getAsociacion()
    {
        return $this->asociacion;
    }

    /**
     * Set programas
     *
     * @param integer $programas
     *
     * @return Asociacion
     */
    public function setProgramas($programas)
    {
        $this->programas = $programas;

        return $this;
    }

    /**
     * Get programas
     *
     * @return int
     */
    public function getProgramas()
    {
        return $this->programas;
    }

    /**
     * Convierte objeto en String
     *
     * Lo usamos para sacar los nombres de los programas
     */
    public function __toString()
    {
        return $this->name;
    }
}

