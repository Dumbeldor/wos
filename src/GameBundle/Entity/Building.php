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
     * @var int
     *
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;


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
     * @ORM\OneToMany(targetEntity="BuildingRequired", mappedBy="buildingChild")
     */
    private $required;

    /**
     * @ORM\OneToMany(targetEntity="BuildingRequired", mappedBy="buildingFather")
     */
    private $buildingFather;

    /**
     * @ORM\OneToMany(targetEntity="BuildingRessource", mappedBy="building")
     */
    private $ressources;

    /**
     * @ORM\ManyToOne(targetEntity="BuildingType", inversedBy="buildings")
     * @ORM\JoinColumn(name="building_type_id", referencedColumnName="id")
     */
    private $buildingType;

    /**
     * @ORM\OneToMany(targetEntity="TownBuilding", mappedBy="building")
     */
    private $towns;



    public function getName() {

        return ' lvl '.$this->lvl.' '.$this->buildingType->getName();
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

    /**
     * Set buildingType
     *
     * @param \GameBundle\Entity\BuildingType $buildingType
     *
     * @return Building
     */
    public function setBuildingType(\GameBundle\Entity\BuildingType $buildingType = null)
    {
        $this->buildingType = $buildingType;

        return $this;
    }

    /**
     * Get buildingType
     *
     * @return \GameBundle\Entity\BuildingType
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * Add required
     *
     * @param \GameBundle\Entity\BuildingRequired $required
     *
     * @return Building
     */
    public function addRequired(\GameBundle\Entity\BuildingRequired $required)
    {
        $this->required[] = $required;

        return $this;
    }

    /**
     * Remove required
     *
     * @param \GameBundle\Entity\BuildingRequired $required
     */
    public function removeRequired(\GameBundle\Entity\BuildingRequired $required)
    {
        $this->required->removeElement($required);
    }

    /**
     * Add buildingFather
     *
     * @param \GameBundle\Entity\BuildingRequired $buildingFather
     *
     * @return Building
     */
    public function addBuildingFather(\GameBundle\Entity\BuildingRequired $buildingFather)
    {
        $this->buildingFather[] = $buildingFather;

        return $this;
    }

    /**
     * Remove buildingFather
     *
     * @param \GameBundle\Entity\BuildingRequired $buildingFather
     */
    public function removeBuildingFather(\GameBundle\Entity\BuildingRequired $buildingFather)
    {
        $this->buildingFather->removeElement($buildingFather);
    }

    /**
     * Get buildingFather
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuildingFather()
    {
        return $this->buildingFather;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Building
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Add town
     *
     * @param \GameBundle\Entity\TownBuilding $town
     *
     * @return Building
     */
    public function addTown(\GameBundle\Entity\TownBuilding $town)
    {
        $this->towns[] = $town;

        return $this;
    }

    /**
     * Remove town
     *
     * @param \GameBundle\Entity\TownBuilding $town
     */
    public function removeTown(\GameBundle\Entity\TownBuilding $town)
    {
        $this->towns->removeElement($town);
    }

    /**
     * Get towns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTowns()
    {
        return $this->towns;
    }
}
