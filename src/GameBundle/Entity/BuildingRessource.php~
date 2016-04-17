<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingRessource
 *
 * @ORM\Table(name="building_ressource")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\BuildingRessourceRepository")
 */
class BuildingRessource
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
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="ressources")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    /**
     * @ORM\ManyToOne(targetEntity="Ressource", inversedBy="buildings")
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
     * @return BuildingRessource
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
     * Set building
     *
     * @param \GameBundle\Entity\Building $building
     *
     * @return BuildingRessource
     */
    public function setBuilding(\GameBundle\Entity\Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return \GameBundle\Entity\Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set ressource
     *
     * @param \GameBundle\Entity\Ressource $ressource
     *
     * @return BuildingRessource
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
