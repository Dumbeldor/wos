<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TownBulding
 *
 * @ORM\Table(name="town_bulding")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\TownBuldingRepository")
 */
class TownBulding
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
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;


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
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return TownBulding
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return int
     */
    public function getLvl()
    {
        return $this->lvl;
    }
}
