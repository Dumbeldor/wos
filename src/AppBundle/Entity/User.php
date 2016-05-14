<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="GameBundle\Entity\Town", mappedBy="user")
     */
    protected $town;

    /**
     * @ORM\OneToMany(targetEntity="GameBundle\Entity\ClanUser", mappedBy="user")
     */
    protected $clan;

    /**
     * @ORM\OneToMany(targetEntity="GameBundle\Entity\ClanCandidature", mappedBy="user")
     */
    protected $clanCandidatures;

    /**
     * @ORM\OneToOne(targetEntity="GameBundle\Entity\Town", cascade={"persist"})
     */
    protected $townCurrant;

    /**
     * @var \DateTime
     * * @ORM\Column(name="last_activity", type="datetime", nullable=true)
     */
    protected $lastActivity;



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    


    /**
     * Add town
     *
     * @param \GameBundle\Entity\Town $town
     *
     * @return User
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

    /**
     * Set townCurrant
     *
     * @param \GameBundle\Entity\Town $townCurrant
     *
     * @return User
     */
    public function setTownCurrant(\GameBundle\Entity\Town $townCurrant = null)
    {
        $this->townCurrant = $townCurrant;

        return $this;
    }

    /**
     * Get townCurrant
     *
     * @return \GameBundle\Entity\Town
     */
    public function getTownCurrant()
    {
        return $this->townCurrant;
    }
    

    /**
     * Set lastActivity
     *
     * @param \DateTime $lastActivity
     *
     * @return User
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;

        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return \DateTime
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Add clan
     *
     * @param \GameBundle\Entity\Clan $clan
     *
     * @return User
     */
    public function addClan(\GameBundle\Entity\Clan $clan)
    {
        $this->clan[] = $clan;

        return $this;
    }

    /**
     * Remove clan
     *
     * @param \GameBundle\Entity\Clan $clan
     */
    public function removeClan(\GameBundle\Entity\Clan $clan)
    {
        $this->clan->removeElement($clan);
    }

    /**
     * Get clan
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClan()
    {
        return $this->clan;
    }

    /**
     * Add clanCandidature
     *
     * @param \GameBundle\Entity\ClanCandidature $clanCandidature
     *
     * @return User
     */
    public function addClanCandidature(\GameBundle\Entity\ClanCandidature $clanCandidature)
    {
        $this->clanCandidatures[] = $clanCandidature;

        return $this;
    }

    /**
     * Remove clanCandidature
     *
     * @param \GameBundle\Entity\ClanCandidature $clanCandidature
     */
    public function removeClanCandidature(\GameBundle\Entity\ClanCandidature $clanCandidature)
    {
        $this->clanCandidatures->removeElement($clanCandidature);
    }

    /**
     * Get clanCandidatures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClanCandidatures()
    {
        return $this->clanCandidatures;
    }
}
