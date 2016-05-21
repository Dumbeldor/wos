<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clan
 *
 * @ORM\Table(name="clan")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ClanRepository")
 */
class Clan
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
     * @ORM\Column(name="name", type="string", length=150, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var int
     *
     * @ORM\Column(name="point", type="integer")
     */
    private $point;

    /**
     * @var int
     *
     * @ORM\Column(name="xp", type="integer")
     */
    private $xp;

    /**
     * @ORM\ManyToMany(targetEntity="Clan", cascade={"persist"})
     */
    private $ally;

    /**
     * @ORM\OneToMany(targetEntity="ClanUser", mappedBy="clan")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="ClanCandidature", mappedBy="clan")
     */
    private $candidatures;

    /**
     * @ORM\OneToMany(targetEntity="ClanAllyCandidature", mappedBy="clanCible")
     */
    private $candidatureAlly;

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
     * @return Clan
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
     * Set texte
     *
     * @param string $texte
     *
     * @return Clan
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->candidatures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \GameBundle\Entity\ClanUser $user
     *
     * @return Clan
     */
    public function addUser(\GameBundle\Entity\ClanUser $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \GameBundle\Entity\ClanUser $user
     */
    public function removeUser(\GameBundle\Entity\ClanUser $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add candidature
     *
     * @param \GameBundle\Entity\ClanCandidature $candidature
     *
     * @return Clan
     */
    public function addCandidature(\GameBundle\Entity\ClanCandidature $candidature)
    {
        $this->candidatures[] = $candidature;

        return $this;
    }

    /**
     * Remove candidature
     *
     * @param \GameBundle\Entity\ClanCandidature $candidature
     */
    public function removeCandidature(\GameBundle\Entity\ClanCandidature $candidature)
    {
        $this->candidatures->removeElement($candidature);
    }

    /**
     * Get candidatures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidatures()
    {
        return $this->candidatures;
    }

    /**
     * Set point
     *
     * @param integer $point
     *
     * @return Clan
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return integer
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set xp
     *
     * @param integer $xp
     *
     * @return Clan
     */
    public function setXp($xp)
    {
        $this->xp = $xp;

        return $this;
    }

    /**
     * Get xp
     *
     * @return integer
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Add ally
     *
     * @param \GameBundle\Entity\Clan $ally
     *
     * @return Clan
     */
    public function addAlly(\GameBundle\Entity\Clan $ally)
    {
        $this->ally[] = $ally;

        return $this;
    }

    /**
     * Remove ally
     *
     * @param \GameBundle\Entity\Clan $ally
     */
    public function removeAlly(\GameBundle\Entity\Clan $ally)
    {
        $this->ally->removeElement($ally);
    }

    /**
     * Get ally
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlly()
    {
        return $this->ally;
    }

    /**
     * Add candidatureAlly
     *
     * @param \GameBundle\Entity\ClanAllyCandidature $candidatureAlly
     *
     * @return Clan
     */
    public function addCandidatureAlly(\GameBundle\Entity\ClanAllyCandidature $candidatureAlly)
    {
        $this->candidatureAlly[] = $candidatureAlly;

        return $this;
    }

    /**
     * Remove candidatureAlly
     *
     * @param \GameBundle\Entity\ClanAllyCandidature $candidatureAlly
     */
    public function removeCandidatureAlly(\GameBundle\Entity\ClanAllyCandidature $candidatureAlly)
    {
        $this->candidatureAlly->removeElement($candidatureAlly);
    }

    /**
     * Get candidatureAlly
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidatureAlly()
    {
        return $this->candidatureAlly;
    }
}
