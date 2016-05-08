<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Town
 *
 * @ORM\Table(name="town")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\TownRepository")
 */
class Town
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
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="town")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Element", inversedBy="town")
     * @ORM\JoinColumn(name="element_id", referencedColumnName="id")
     */
    private $element;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="resident", type="integer")
     */
    private $resident;

    /**
     * @var int
     *
     * @ORM\Column(name="point", type="integer")
     */
    private $point;

    /**
     * @ORM\OneToMany(targetEntity="Map", mappedBy="town")
     */
    protected $map;

    /**
     * @ORM\OneToMany(targetEntity="TownRessource", mappedBy="town")
     */
    private $ressources;

    /**
     * @ORM\OneToMany(targetEntity="TownBuilding", mappedBy="town")
     */
    private $buildings;

    /**
     * @ORM\OneToMany(targetEntity="TownInfantry", mappedBy="town")
     */
    private $infantrys;



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
     * @return Town
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
     * Set habitant
     *
     * @param integer $habitant
     *
     * @return Town
     */
    public function setHabitant($habitant)
    {
        $this->habitant = $habitant;

        return $this;
    }

    /**
     * Get habitant
     *
     * @return int
     */
    public function getHabitant()
    {
        return $this->habitant;
    }

    public function addPoint($point) {
        $this->point += $point;
    }

    /**
     * Set point
     *
     * @param integer $point
     *
     * @return Town
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return int
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set x
     *
     * @param integer $x
     *
     * @return Town
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
     * @return Town
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Town
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ressources = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ressource
     *
     * @param \GameBundle\Entity\TownRessource $ressource
     *
     * @return Town
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

    public function addResident($habitant) {
        $this->resident += $habitant;
    }

    /**
     * Set resident
     *
     * @param integer $resident
     *
     * @return Town
     */
    public function setResident($resident)
    {
        $this->resident = $resident;

        return $this;
    }

    /**
     * Get resident
     *
     * @return integer
     */
    public function getResident()
    {
        return $this->resident;
    }

    /**
     * Add infantry
     *
     * @param \GameBundle\Entity\TownInfantry $infantry
     *
     * @return Town
     */
    public function addInfantry(\GameBundle\Entity\TownInfantry $infantry)
    {
        $this->infantrys[] = $infantry;

        return $this;
    }

    /**
     * Remove infantry
     *
     * @param \GameBundle\Entity\TownInfantry $infantry
     */
    public function removeInfantry(\GameBundle\Entity\TownInfantry $infantry)
    {
        $this->infantrys->removeElement($infantry);
    }

    /**
     * Get infantrys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfantrys()
    {
        return $this->infantrys;
    }

    /**
     * Add building
     *
     * @param \GameBundle\Entity\TownBuilding $building
     *
     * @return Town
     */
    public function addBuilding(\GameBundle\Entity\TownBuilding $building)
    {
        $this->buildings[] = $building;

        return $this;
    }

    /**
     * Remove building
     *
     * @param \GameBundle\Entity\TownBuilding $building
     */
    public function removeBuilding(\GameBundle\Entity\TownBuilding $building)
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

    /**
     * Add map
     *
     * @param \GameBundle\Entity\Map $map
     *
     * @return Town
     */
    public function addMap(\GameBundle\Entity\Map $map)
    {
        $this->map[] = $map;

        return $this;
    }

    /**
     * Remove map
     *
     * @param \GameBundle\Entity\Map $map
     */
    public function removeMap(\GameBundle\Entity\Map $map)
    {
        $this->map->removeElement($map);
    }

    /**
     * Get map
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set element
     *
     * @param \GameBundle\Entity\Element $element
     *
     * @return Town
     */
    public function setElement(\GameBundle\Entity\Element $element = null)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return \GameBundle\Entity\Element
     */
    public function getElement()
    {
        return $this->element;
    }
}
