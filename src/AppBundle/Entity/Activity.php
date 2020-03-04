<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="activities")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * Many Activities belongs to Many Asociations.
     * @ORM\ManyToMany(targetEntity="Asociacion", inversedBy="activities")
     * @ORM\JoinTable(name="asociaciones_activities",
     *      joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="asociaciones", referencedColumnName="id")}
     *      )
     */
    private $asociaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="activity_name", type="string", length=255)
     */
    private $activityName;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIni", type="datetime")
     */
    private $fechaIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="datetime")
     */
    private $fechaFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="destacado", type="boolean")
     */
    private $destacado;


    public function __construct() {
        $this->asociaciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set activityName
     *
     * @param string $activityName
     *
     * @return Activity
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;

        return $this;
    }

    /**
     * Get activityName
     *
     * @return string
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Activity
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
     * @return Activity
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
     * @return Activity
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
     * Set fechaIni
     *
     * @param \DateTime $fechaIni
     *
     * @return Activity
     */
    public function setFechaIni($fechaIni)
    {
        $this->fechaIni = $fechaIni;

        return $this;
    }

    /**
     * Get fechaIni
     *
     * @return \DateTime
     */
    public function getFechaIni()
    {
        return $this->fechaIni;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Activity
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set destacado
     *
     * @param boolean $destacado
     *
     * @return Activity
     */
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;

        return $this;
    }

    /**
     * Get destacado
     *
     * @return bool
     */
    public function getDestacado()
    {
        return $this->destacado;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Activity
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * Add asociaciones
     *
     * @param \AppBundle\Entity\Asociacion $asociaciones
     *
     * @return Activity
     */
    public function addAsociacione(\AppBundle\Entity\Asociacion $asociaciones)
    {
        $this->asociaciones[] = $asociaciones;

        return $this;
    }

    /**
     * Remove asociaciones
     *
     * @param \AppBundle\Entity\Asociacion $asociaciones
     */
    public function removeAsociacione(\AppBundle\Entity\Asociacion $asociaciones)
    {
        $this->asociaciones->removeElement($asociaciones);
    }

    /**
     * Get asociaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAsociaciones()
    {
        return $this->asociaciones;
    }
}
