<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infantry
 *
 * @ORM\Table(name="infantry")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\InfantryRepository")
 */
class Infantry
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="atk", type="integer")
     */
    private $atk;

    /**
     * @var int
     *
     * @ORM\Column(name="defense", type="integer")
     */
    private $defense;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="integer", nullable=true)
     */
    private $time;

    /**
     * @ORM\OneToMany(targetEntity="TownInfantry", mappedBy="infantry")
     */
    private $towns;

    /**
     * @ORM\OneToMany(targetEntity="InfantryRessource", mappedBy="infantry")
     */
    private $ressources;

    /**
     * @ORM\OneToOne(targetEntity="BuildingType", cascade={"persist"})
     */
    private $buildingType;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Infantry
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set atk
     *
     * @param integer $atk
     *
     * @return Infantry
     */
    public function setAtk($atk)
    {
        $this->atk = $atk;

        return $this;
    }

    /**
     * Get atk
     *
     * @return int
     */
    public function getAtk()
    {
        return $this->atk;
    }

    /**
     * Set defense
     *
     * @param integer $defense
     *
     * @return Infantry
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense
     *
     * @return int
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Infantry
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
        $this->towns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add town
     *
     * @param \GameBundle\Entity\TownInfantry $town
     *
     * @return Infantry
     */
    public function addTown(\GameBundle\Entity\TownInfantry $town)
    {
        $this->towns[] = $town;

        return $this;
    }

    /**
     * Remove town
     *
     * @param \GameBundle\Entity\TownInfantry $town
     */
    public function removeTown(\GameBundle\Entity\TownInfantry $town)
    {
        $this->towns->removeElement($town);
    }

    /**
     * Get towns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTowns()
    {
        return $this->towns;
    }

    /**
     * Add ressource
     *
     * @param \GameBundle\Entity\InfantryRessource $ressource
     *
     * @return Infantry
     */
    public function addRessource(\GameBundle\Entity\InfantryRessource $ressource)
    {
        $this->ressources[] = $ressource;

        return $this;
    }

    /**
     * Remove ressource
     *
     * @param \GameBundle\Entity\InfantryRessource $ressource
     */
    public function removeRessource(\GameBundle\Entity\InfantryRessource $ressource)
    {
        $this->ressources->removeElement($ressource);
    }

    /**
     * Get ressources
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRessources()
    {
        return $this->ressources;
    }


    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Infantry
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set buildingType
     *
     * @param \GameBundle\Entity\BuildingType $buildingType
     *
     * @return Infantry
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
