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
 * InfantryBuild
 *
 * @ORM\Table(name="infantry_build")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\InfantryBuildRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class InfantryBuild
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
     * @var int
     *
     * @ORM\Column(name="beginFormation", type="integer")
     */
    private $beginFormation;

    /**
     * @ORM\ManyToOne(targetEntity="Infantry", inversedBy="ressources")
     * @ORM\JoinColumn(name="infantry_id", referencedColumnName="id")
     */
    private $infantry;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="infantrys")
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
     * Set infantry
     *
     * @param \GameBundle\Entity\Infantry $infantry
     *
     * @return InfantryBuild
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


    /**
     * Set beginFormation
     *
     * @param integer $beginFormation
     *
     * @return InfantryBuild
     */
    public function setBeginFormation($beginFormation)
    {
        $this->beginFormation = $beginFormation;

        return $this;
    }

    /**
     * Get beginFormation
     *
     * @return integer
     */
    public function getBeginFormation()
    {
        return $this->beginFormation;
    }

    /**
     * Set nb
     *
     * @param integer $nb
     *
     * @return InfantryBuild
     */
    public function setNb($nb)
    {
        $this->nb = $nb;

        return $this;
    }

    /**
     * Get nb
     *
     * @return integer
     */
    public function getNb()
    {
        return $this->nb;
    }

    public function addNb($nb)
    {
        $this->nb += $nb;

        return $this;
    }

    /**
     * Set town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return InfantryBuild
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
}
