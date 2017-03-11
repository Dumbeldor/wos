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
 * Diplomaty
 *
 * @ORM\Table(name="diplomaty")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\DiplomatyRepository")
 */
class Diplomaty
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
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="ClanDiplomatyCandidature", mappedBy="diplomaty")
     */
    private $diplomatyCandidature;

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
     * @return Diplomaty
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
     * Constructor
     */
    public function __construct()
    {
        $this->diplomatyCandidature = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diplomatyCandidature
     *
     * @param \GameBundle\Entity\ClanDiplomatyCandidature $diplomatyCandidature
     *
     * @return Diplomaty
     */
    public function addDiplomatyCandidature(\GameBundle\Entity\ClanDiplomatyCandidature $diplomatyCandidature)
    {
        $this->diplomatyCandidature[] = $diplomatyCandidature;

        return $this;
    }

    /**
     * Remove diplomatyCandidature
     *
     * @param \GameBundle\Entity\ClanDiplomatyCandidature $diplomatyCandidature
     */
    public function removeDiplomatyCandidature(\GameBundle\Entity\ClanDiplomatyCandidature $diplomatyCandidature)
    {
        $this->diplomatyCandidature->removeElement($diplomatyCandidature);
    }

    /**
     * Get diplomatyCandidature
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiplomatyCandidature()
    {
        return $this->diplomatyCandidature;
    }
}
