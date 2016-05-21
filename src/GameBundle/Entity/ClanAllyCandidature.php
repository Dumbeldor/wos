<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClanAllyCandidature
 *
 * @ORM\Table(name="clan_ally_candidature")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\ClanAllyCandidatureRepository")
 */
class ClanAllyCandidature
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
     * @ORM\JoinColumn(name="clan_cible_id", referencedColumnName="id")
     */
    private $clanCible;

    /**
     * @ORM\ManyToOne(targetEntity="Clan", inversedBy="candidatures")
     * @ORM\JoinColumn(name="clan_source_id", referencedColumnName="id")
     */
    private $clanSource;


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
     * @return ClanAllyCandidature
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
     * @param \GameBundle\Entity\Clan $cpu  lanCible
     *
     * @return ClanAllyCandidature
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
     * @return ClanAllyCandidature
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
}
