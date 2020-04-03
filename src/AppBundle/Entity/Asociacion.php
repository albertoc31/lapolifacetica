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
     * @var array
     * One asociacion has many users. This is the inverse side.
     * @ORM\OneToMany(targetEntity="User", mappedBy="asociacion")
     * @ORM\Column(name="users_ids", type="simple_array", nullable=true)
     */
    private $users;

    /**
     * Many Activities belongs to Many Asociations.
     * @ORM\ManyToMany(targetEntity="Activity", mappedBy="asociaciones")
     */
    private $activities;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

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
     * Set users
     *
     * @param array $users
     *
     * @return Asociacion
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
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
     * Set email
     *
     * @param string $email
     *
     * @return Asociacion
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Convierte objeto en String
     *
     * Lo usamos para sacar los nombres de los users
     */
    public function __toString()
    {
        return $this->name;
    }
}
