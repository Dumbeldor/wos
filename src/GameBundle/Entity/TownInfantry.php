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
 * TownInfantry
 *
 * @ORM\Table(name="town_infantry")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\TownInfantryRepository")
 */
class TownInfantry
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
     * @ORM\Column(name="nb", type="integer")
     */
    private $nb;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="infantrys")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id")
     */
    private $town;

    /**
     * @ORM\ManyToOne(targetEntity="Infantry", inversedBy="towns")
     * @ORM\JoinColumn(name="infantry_id", referencedColumnName="id")
     */
    private $infantry;


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
     * Set nb
     *
     * @param integer $nb
     *
     * @return TownInfantry
     */
    public function setNb($nb)
    {
        $this->nb = $nb;

        return $this;
    }

    /**
     * Get nb
     *
     * @return int
     */
    public function getNb()
    {
        return $this->nb;
    }

    /**
     * Set town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return TownInfantry
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
     * Set infantry
     *
     * @param \GameBundle\Entity\Infantry $infantry
     *
     * @return TownInfantry
     */
    public function setInfantry(\GameBundle\Entity\Infantry $infantry = null)
    {
        $this->infantry = $infantry;

        return $this;
    }

    /**
     * Get infantry
     *
     * @return \GameBundle\Entity\Infantry
     */
    public function getInfantry()
    {
        return $this->infantry;
    }
}
