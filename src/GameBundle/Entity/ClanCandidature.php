<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClanCandidature
 *
 * @ORM\Table(name="clan_candidature")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ClanCandidatureRepository")
 */
class ClanCandidature
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
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="Clan", inversedBy="candidatures")
     * @ORM\JoinColumn(name="clan_id", referencedColumnName="id")
     */
    private $clan;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="clanCandidatures")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set texte
     *
     * @param string $texte
     *
     * @return ClanCandidature
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
     * Set clan
     *
     * @param \GameBundle\Entity\Clan $clan
     *
     * @return ClanCandidature
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
     * @return ClanCandidature
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
}
