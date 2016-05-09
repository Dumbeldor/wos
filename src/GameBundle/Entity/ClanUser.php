<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClanUser
 *
 * @ORM\Table(name="clan_user")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ClanUserRepository")
 */
class ClanUser
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
     * @ORM\ManyToOne(targetEntity="Clan", inversedBy="users")
     * @ORM\JoinColumn(name="clan_id", referencedColumnName="id")
     */
    private $clan;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="clan")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="ClanRank", inversedBy="users")
     * @ORM\JoinColumn(name="rank_id", referencedColumnName="id")
     */
    private $rank;





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
     * Set clan
     *
     * @param \GameBundle\Entity\Clan $clan
     *
     * @return ClanUser
     */
    public function setClan(\GameBundle\Entity\Clan $clan = null)
    {
        $this->clan = $clan;

        return $this;
    }

    /**
     * Get clan
     *
     * @return \GameBundle\Entity\Clan
     */
    public function getClan()
    {
        return $this->clan;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ClanUser
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
     * Set rank
     *
     * @param \GameBundle\Entity\ClanRank $rank
     *
     * @return ClanUser
     */
    public function setRank(\GameBundle\Entity\ClanRank $rank = null)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return \GameBundle\Entity\ClanRank
     */
    public function getRank()
    {
        return $this->rank;
    }
}
