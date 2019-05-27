<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agrupacion
 *
 * @ORM\Table(name="agrupacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgrupacionRepository")
 */
class Agrupacion
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="barrio", type="string", length=255)
     */
    private $barrio;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;

    /**
     * @var int
     *
     * @ORM\Column(name="miembros", type="smallint")
     */
    private $miembros;

    /**
     * @var array
     *
     * @ORM\Column(name="miembros_ids", type="simple_array")
     */
    private $miembrosIds;


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
     * @return Agrupacion
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
     * Set barrio
     *
     * @param string $barrio
     *
     * @return Agrupacion
     */
    public function setBarrio($barrio)
    {
        $this->barrio = $barrio;

        return $this;
    }

    /**
     * Get barrio
     *
     * @return string
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Agrupacion
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Agrupacion
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set miembros
     *
     * @param integer $miembros
     *
     * @return Agrupacion
     */
    public function setMiembros($miembros)
    {
        $this->miembros = $miembros;

        return $this;
    }

    /**
     * Get miembros
     *
     * @return int
     */
    public function getMiembros()
    {
        return $this->miembros;
    }

    /**
     * Set miembrosIds
     *
     * @param array $miembrosIds
     *
     * @return Agrupacion
     */
    public function setMiembrosIds($miembrosIds)
    {
        $this->miembrosIds = $miembrosIds;

        return $this;
    }

    /**
     * Get miembrosIds
     *
     * @return array
     */
    public function getMiembrosIds()
    {
        return $this->miembrosIds;
    }

    /**
     * Convierte objeto en String
     *
     * Lo usamos para sacar los nombres de las agrupaciones
     */
    public function __toString()
    {
        return $this->name;
    }
}
