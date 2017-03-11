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
 * BuildingRequired
 *
 * @ORM\Table(name="building_required")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\BuildingRequiredRepository")
 */
class BuildingRequired
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
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="required")
     * @ORM\JoinColumn(name="building_child_id", referencedColumnName="id")
     */
    private $buildingChild;

    /**
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="buildingFather")
     * @ORM\JoinColumn(name="building_father_id", referencedColumnName="id")
     */
    private $buildingFather;


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
     * @return BuildingRequired
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
     * Set buildingChild
     *
     * @param \GameBundle\Entity\Building $buildingChild
     *
     * @return BuildingRequired
     */
    public function setBuildingChild(\GameBundle\Entity\Building $buildingChild = null)
    {
        $this->buildingChild = $buildingChild;

        return $this;
    }

    /**
     * Get buildingChild
     *
     * @return \GameBundle\Entity\Building
     */
    public function getBuildingChild()
    {
        return $this->buildingChild;
    }

    /**
     * Set buildingFather
     *
     * @param \GameBundle\Entity\Building $buildingFather
     *
     * @return BuildingRequired
     */
    public function setBuildingFather(\GameBundle\Entity\Building $buildingFather = null)
    {
        $this->buildingFather = $buildingFather;

        return $this;
    }

    /**
     * Get buildingFather
     *
     * @return \GameBundle\Entity\Building
     */
    public function getBuildingFather()
    {
        return $this->buildingFather;
    }
}
