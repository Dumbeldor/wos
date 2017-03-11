<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingBuild
 *
 * @ORM\Table(name="building_build")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\BuildingBuildRepository")
 */
class BuildingBuild
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
     * @ORM\Column(name="endBuild", type="integer")
     */
    private $endBuild;

    /**
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="buildingBuild")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    /**
     * @ORM\ManyToOne(targetEntity="BuildingType")
     * @ORM\JoinColumn(name="building_type_id", referencedColumnName="id")
     */
    private $buildingType;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="buildingBuild")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id")
     */
    private $town;


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
     * Set endBuild
     *
     * @param integer $endBuild
     *
     * @return BuildingBuild
     */
    public function setEndBuild($endBuild)
    {
        $this->endBuild = $endBuild;

        return $this;
    }

    /**
     * Get endBuild
     *
     * @return int
     */
    public function getEndBuild()
    {
        return $this->endBuild;
    }

    /**
     * Set building
     *
     * @param \GameBundle\Entity\Building $building
     *
     * @return BuildingBuild
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
     * Set town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return BuildingBuild
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
     * Set buildingType
     *
     * @param \GameBundle\Entity\BuildingType $buildingType
     *
     * @return BuildingBuild
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
