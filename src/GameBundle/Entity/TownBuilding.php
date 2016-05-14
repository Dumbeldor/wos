<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TownBulding
 *
 * @ORM\Table(name="town_building")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\TownBuldingRepository")
 */
class TownBuilding
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
     * @ORM\ManyToOne(targetEntity="BuildingType", inversedBy="towns")
     * @ORM\JoinColumn(name="building_type_id", referencedColumnName="id")
     */
    private $buildingType;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="buildings")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id")
     */
    private $town;

    /**
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="towns")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;


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
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return TownBulding
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return int
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return TownBuilding
     */
    public function setTown(\GameBundle\Entity\Town $town = null)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return \GameBundle\Entity\Town
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set building
     *
     * @param \GameBundle\Entity\Building $building
     *
     * @return TownBuilding
     */
    public function setBuilding(\GameBundle\Entity\Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return \GameBundle\Entity\Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set buildingType
     *
     * @param \GameBundle\Entity\BuildingType $buildingType
     *
     * @return TownBuilding
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
}
