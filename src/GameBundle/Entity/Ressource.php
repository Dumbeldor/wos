<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ressource
 *
 * @ORM\Table(name="ressource")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\RessourceRepository")
 */
class Ressource
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="add", type="integer")
     */
    private $add;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity="TownRessource", mappedBy="ressource")
     */
    private $ressources;

    /**
     * @ORM\OneToMany(targetEntity="BuildingRessource", mappedBy="ressource")
     */
    private $buildings;



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
     * @return Ressource
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
     * Set description
     *
     * @param string $description
     *
     * @return Ressource
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set add
     *
     * @param integer $add
     *
     * @return Ressource
     */
    public function setAdd($add)
    {
        $this->add = $add;

        return $this;
    }

    /**
     * Get add
     *
     * @return int
     */
    public function getAdd()
    {
        return $this->add;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Ressource
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
        $this->town = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add town
     *
     * @param \GameBundle\Entity\TownRessource $town
     *
     * @return Ressource
     */
    public function addTown(\GameBundle\Entity\TownRessource $town)
    {
        $this->town[] = $town;

        return $this;
    }

    /**
     * Remove town
     *
     * @param \GameBundle\Entity\TownRessource $town
     */
    public function removeTown(\GameBundle\Entity\TownRessource $town)
    {
        $this->town->removeElement($town);
    }

    /**
     * Get town
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Add ressource
     *
     * @param \GameBundle\Entity\TownRessource $ressource
     *
     * @return Ressource
     */
    public function addRessource(\GameBundle\Entity\TownRessource $ressource)
    {
        $this->ressources[] = $ressource;

        return $this;
    }

    /**
     * Remove ressource
     *
     * @param \GameBundle\Entity\TownRessource $ressource
     */
    public function removeRessource(\GameBundle\Entity\TownRessource $ressource)
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
     * Set stock
     *
     * @param integer $stock
     *
     * @return Ressource
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Add building
     *
     * @param \GameBundle\Entity\BuildingRessource $building
     *
     * @return Ressource
     */
    public function addBuilding(\GameBundle\Entity\BuildingRessource $building)
    {
        $this->buildings[] = $building;

        return $this;
    }

    /**
     * Remove building
     *
     * @param \GameBundle\Entity\BuildingRessource $building
     */
    public function removeBuilding(\GameBundle\Entity\BuildingRessource $building)
    {
        $this->buildings->removeElement($building);
    }

    /**
     * Get buildings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuildings()
    {
        return $this->buildings;
    }
}
