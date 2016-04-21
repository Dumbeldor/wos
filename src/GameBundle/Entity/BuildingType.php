<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BatimentType
 *
 * @ORM\Table(name="building_type")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\BuildingTypeRepository")
 */
class BuildingType
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="text")
     */
    private $descr;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_ressource", type="boolean")
     */
    private $is_ressource;

    /**
     * @ORM\ManyToOne(targetEntity="Ressource")
     * @ORM\JoinColumn(name="ressource_id", referencedColumnName="id")
     */
    private $ressource;

    /**
     * @ORM\OneToMany(targetEntity="Building", mappedBy="buildingType")
     */
    private $buildings;

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
     * @return BatimentType
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
     * Set descr
     *
     * @param string $descr
     *
     * @return BatimentType
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get descr
     *
     * @return string
     */
    public function getDescr()
    {
        return $this->descr;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->buildings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isRessource
     *
     * @param boolean $isRessource
     *
     * @return BuildingType
     */
    public function setIsRessource($isRessource)
    {
        $this->is_ressource = $isRessource;

        return $this;
    }

    /**
     * Get isRessource
     *
     * @return boolean
     */
    public function getIsRessource()
    {
        return $this->is_ressource;
    }

    /**
     * Add building
     *
     * @param \GameBundle\Entity\Building $building
     *
     * @return BuildingType
     */
    public function addBuilding(\GameBundle\Entity\Building $building)
    {
        $this->buildings[] = $building;

        return $this;
    }

    /**
     * Remove building
     *
     * @param \GameBundle\Entity\Building $building
     */
    public function removeBuilding(\GameBundle\Entity\Building $building)
    {
        $this->buildings->removeElement($building);
    }

    /**
     * Get buildings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * Set ressource
     *
     * @param \GameBundle\Entity\Ressource $ressource
     *
     * @return BuildingType
     */
    public function setRessource(\GameBundle\Entity\Ressource $ressource = null)
    {
        $this->ressource = $ressource;

        return $this;
    }

    /**
     * Get ressource
     *
     * @return \GameBundle\Entity\Ressource
     */
    public function getRessource()
    {
        return $this->ressource;
    }
}
