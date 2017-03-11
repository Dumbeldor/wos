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
 * InfantryRessource
 *
 * @ORM\Table(name="infantry_ressource")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\InfantryRessourceRepository")
 */
class InfantryRessource
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
     * @ORM\ManyToOne(targetEntity="Infantry", inversedBy="ressources")
     * @ORM\JoinColumn(name="infantry_id", referencedColumnName="id")
     */
    private $infantry;

    /**
     * @ORM\ManyToOne(targetEntity="Ressource", inversedBy="infantrys")
     * @ORM\JoinColumn(name="ressource_id", referencedColumnName="id")
     */
    private $ressource;



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
     * @return InfantryRessource
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
     * Set infantry
     *
     * @param \GameBundle\Entity\Infantry $infantry
     *
     * @return InfantryRessource
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
     * Set ressource
     *
     * @param \GameBundle\Entity\Ressource $ressource
     *
     * @return InfantryRessource
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
