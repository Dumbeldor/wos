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
 * ClanDiplomatyCandidature
 *
 * @ORM\Table(name="clan_diplomaty_candidature")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ClanDiplomatyCandidatureRepository")
 */
class ClanDiplomatyCandidature
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
     * @ORM\ManyToOne(targetEntity="Clan", inversedBy="diplomatyCandidature")
     * @ORM\JoinColumn(name="clan_cible_id", referencedColumnName="id")
     */
    private $clanCible;

    /**
     * @ORM\ManyToOne(targetEntity="Clan")
     * @ORM\JoinColumn(name="clan_source_id", referencedColumnName="id")
     */
    private $clanSource;

    /**
     * @ORM\ManyToOne(targetEntity="Diplomaty", inversedBy="diplomatyCandidature")
     * @ORM\JoinColumn(name="diplomaty_id", referencedColumnName="id")
     */
    private $diplomaty;


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
     * @return ClanDiplomatyCandidature
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
     * Set clanCible
     *
     * @param \GameBundle\Entity\Clan $clanCible
     *
     * @return ClanDiplomatyCandidature
     */
    public function setClanCible(\GameBundle\Entity\Clan $clanCible = null)
    {
        $this->clanCible = $clanCible;

        return $this;
    }

    /**
     * Get clanCible
     *
     * @return \GameBundle\Entity\Clan
     */
    public function getClanCible()
    {
        return $this->clanCible;
    }

    /**
     * Set clanSource
     *
     * @param \GameBundle\Entity\Clan $clanSource
     *
     * @return ClanDiplomatyCandidature
     */
    public function setClanSource(\GameBundle\Entity\Clan $clanSource = null)
    {
        $this->clanSource = $clanSource;

        return $this;
    }

    /**
     * Get clanSource
     *
     * @return \GameBundle\Entity\Clan
     */
    public function getClanSource()
    {
        return $this->clanSource;
    }

    /**
     * Set diplomaty
     *
     * @param \GameBundle\Entity\Diplomaty $diplomaty
     *
     * @return ClanDiplomatyCandidature
     */
    public function setDiplomaty(\GameBundle\Entity\Diplomaty $diplomaty = null)
    {
        $this->diplomaty = $diplomaty;

        return $this;
    }

    /**
     * Get diplomaty
     *
     * @return \GameBundle\Entity\Diplomaty
     */
    public function getDiplomaty()
    {
        return $this->diplomaty;
    }
}
