<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

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
     * Many Activities belongs to Many Asociations.
     * @ORM\ManyToMany(targetEntity="Activity")
     * @ORM\JoinTable(name="asociaciones_activities",
     *      joinColumns={@ORM\JoinColumn(name="asociaciones", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id", referencedColumnName="id")}
     *      )
     */
    private $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }


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
     * Set description
     *
     * @param string $description
     *
     * @return Asociacion
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
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Asociacion
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Asociacion
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
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
     * Set activities
     *
     * @param integer $activities
     *
     * @return Asociacion
     */
    public function setActivities($activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * Get activities
     *
     * @return int
     */
    public function getActivities()
    {
        return $this->activities;
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
