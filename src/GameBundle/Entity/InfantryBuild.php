<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfantryBuild
 *
 * @ORM\Table(name="infantry_build")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\InfantryBuildRepository")
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
     * @ORM\Column(name="endFormation", type="integer")
     */
    private $endFormation;

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
     * Set endFormation
     *
     * @param integer $endFormation
     *
     * @return InfantryBuild
     */
    public function setEndFormation($endFormation)
    {
        $this->endFormation = $endFormation;

        return $this;
    }

    /**
     * Get endFormation
     *
     * @return int
     */
    public function getEndFormation()
    {
        return $this->endFormation;
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
     * Set ressource
     *
     * @param \GameBundle\Entity\Ressource $ressource
     *
     * @return InfantryBuild
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
