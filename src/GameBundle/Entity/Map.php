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
 * Map
 *
 * @ORM\Table(name="map")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\MapRepository")
 */
class Map
{
    /**
     * @var int
     * @ORM\Id
     *
     * @ORM\Column(name="x", type="integer")
     */
    private $x;

    /**
     * @var int
     * @ORM\Id
     *
     * @ORM\Column(name="y", type="integer")
     */
    private $y;


    /**
     * @ORM\OneToMany(targetEntity="Town", mappedBy="map")
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
     * Set x
     *
     * @param integer $x
     *
     * @return Map
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     *
     * @return Map
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return Map
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
     * Constructor
     */
    public function __construct()
    {
        $this->town = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return Map
     */
    public function addTown(\GameBundle\Entity\Town $town)
    {
        $this->town[] = $town;

        return $this;
    }

    /**
     * Remove town
     *
     * @param \GameBundle\Entity\Town $town
     */
    public function removeTown(\GameBundle\Entity\Town $town)
    {
        $this->town->removeElement($town);
    }
}
