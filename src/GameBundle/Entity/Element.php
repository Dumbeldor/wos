<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ElementRepository")
 */
class Element
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
     * @ORM\OneToMany(targetEntity="Town", mappedBy="element")
     */
    protected $town;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="attack", type="float")
     */
    private $attack;

    /**
     * @var float
     *
     * @ORM\Column(name="defense", type="float")
     */
    private $defense;

    /**
     * @var float
     *
     * @ORM\Column(name="speed", type="float")
     */
    private $speed;

    /**
     * @ORM\OneToOne(targetEntity="Element", cascade={"persist"})
     */
    private $stronger;


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
     * @return Element
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
     * Set attack
     *
     * @param integer $attack
     *
     * @return Element
     */
    public function setAttack($attack)
    {
        $this->attack = $attack;

        return $this;
    }

    /**
     * Get attack
     *
     * @return int
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * Set defense
     *
     * @param integer $defense
     *
     * @return Element
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
     * Set speed
     *
     * @param integer $speed
     *
     * @return Element
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set stronger
     *
     * @param \GameBundle\Entity\Element $stronger
     *
     * @return Element
     */
    public function setStronger(\GameBundle\Entity\Element $stronger = null)
    {
        $this->stronger = $stronger;

        return $this;
    }

    /**
     * Get stronger
     *
     * @return \GameBundle\Entity\Element
     */
    public function getStronger()
    {
        return $this->stronger;
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
     * @return Element
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

    /**
     * Get town
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTown()
    {
        return $this->town;
    }
}
