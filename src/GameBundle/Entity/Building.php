<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\BuildingRepository")
 */
class Building
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="lvlMax", type="integer")
     */
    private $lvlMax;

    /**
     * @var int
     *
     * @ORM\Column(name="add", type="integer", nullable=true)
     */
    private $add;

    /**
     * @var int
     *
     * @ORM\Column(name="addHabitant", type="integer")
     */
    private $addHabitant;

    /**
     * @var int
     *
     * @ORM\Column(name="addPoint", type="integer")
     */
    private $addPoint;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Building")
     * @ORM\JoinColumn(name="required", referencedColumnName="id")
     */
    private $required;

    /**
     * @var int
     *
     * @ORM\Column(name="lvlRequired", type="integer", nullable=true)
     */
    private $lvlRequired;

    /**
     * @ORM\OneToMany(targetEntity="BuildingRessource", mappedBy="building")
     */
    private $ressources;


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
     * @return Building
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
     * Set lvlMax
     *
     * @param integer $lvlMax
     *
     * @return Building
     */
    public function setLvlMax($lvlMax)
    {
        $this->lvlMax = $lvlMax;

        return $this;
    }

    /**
     * Get lvlMax
     *
     * @return int
     */
    public function getLvlMax()
    {
        return $this->lvlMax;
    }

    /**
     * Set add
     *
     * @param integer $add
     *
     * @return Building
     */
    public function setAdd($add)
    {
        $this->add = $add;

        return $this;
    }

    /**
     * Get add
     *
     * @return int
     */
    public function getAdd()
    {
        return $this->add;
    }

    /**
     * Set addHabitant
     *
     * @param integer $addHabitant
     *
     * @return Building
     */
    public function setAddHabitant($addHabitant)
    {
        $this->addHabitant = $addHabitant;

        return $this;
    }

    /**
     * Get addHabitant
     *
     * @return int
     */
    public function getAddHabitant()
    {
        return $this->addHabitant;
    }

    /**
     * Set addPoint
     *
     * @param integer $addPoint
     *
     * @return Building
     */
    public function setAddPoint($addPoint)
    {
        $this->addPoint = $addPoint;

        return $this;
    }

    /**
     * Get addPoint
     *
     * @return int
     */
    public function getAddPoint()
    {
        return $this->addPoint;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Building
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
     * Set required
     *
     * @param \GameBundle\Entity\Building $required
     *
     * @return Building
     */
    public function setRequired(\GameBundle\Entity\Building $required = null)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return \GameBundle\Entity\Building
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set lvlRequired
     *
     * @param integer $lvlRequired
     *
     * @return Building
     */
    public function setLvlRequired($lvlRequired)
    {
        $this->lvlRequired = $lvlRequired;

        return $this;
    }

    /**
     * Get lvlRequired
     *
     * @return integer
     */
    public function getLvlRequired()
    {
        return $this->lvlRequired;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ressource = new \Doctrine\Common\Collections\ArrayCollection();
    }

  

    /**
     * Add ressource
     *
     * @param \GameBundle\Entity\BuildingRessource $ressource
     *
     * @return Building
     */
    public function addRessource(\GameBundle\Entity\BuildingRessource $ressource)
    {
        $this->ressources[] = $ressource;

        return $this;
    }

    /**
     * Remove ressource
     *
     * @param \GameBundle\Entity\BuildingRessource $ressource
     */
    public function removeRessource(\GameBundle\Entity\BuildingRessource $ressource)
    {
        $this->ressources->removeElement($ressource);
    }

    /**
     * Get ressources
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRessources()
    {
        return $this->ressources;
    }
}
