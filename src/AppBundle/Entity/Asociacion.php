<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asociacion
 *
 * @ORM\Table(name="asociacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AsociacionRepository")
 */
class Asociacion
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
     * @var int
     *
     * @ORM\Column(name="miembros", type="smallint")
     */
    private $miembros;

    /**
     * @var array
     *
     * @ORM\Column(name="miembros_ids", type="simple_array", nullable=true)
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
     * @return Asociacion
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
     * Set miembros
     *
     * @param integer $miembros
     *
     * @return Asociacion
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
     * @return Asociacion
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
     * Lo usamos para sacar los nombres de las asociaciones
     */
    public function __toString()
    {
        return $this->name;
    }
}
