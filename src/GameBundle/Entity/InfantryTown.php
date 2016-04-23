<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfantryTown
 *
 * @ORM\Table(name="infantry_town")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\InfantryTownRepository")
 */
class InfantryTown
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
     * @ORM\Column(name="nb", type="integer", nullable=true)
     */
    private $nb;


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
     * @return InfantryTown
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
}
