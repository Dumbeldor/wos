<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClanDiplomaty
 *
 * @ORM\Table(name="clan_diplomaty")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ClanDiplomatyRepository")
 */
class ClanDiplomaty
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
     * @ORM\ManyToOne(targetEntity="Clan", inversedBy="diplomaty")
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
     * Set clanCible
     *
     * @param \GameBundle\Entity\Clan $clanCible
     *
     * @return ClanDiplomaty
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
     * @return ClanDiplomaty
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
     * @return ClanDiplomaty
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
