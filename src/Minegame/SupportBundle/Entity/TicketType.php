<?php

namespace Minegame\SupportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketType
 *
 * @ORM\Table(name="ticket_type")
 * @ORM\Entity(repositoryClass="Minegame\SupportBundle\Repository\TicketTypeRepository")
 */
class TicketType
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
     * @ORM\Column(name="title", type="string", length=150, unique=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Minegame\SupportBundle\Entity\Ticket", mappedBy="type")
     */
    private $tickets;


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
     * Set title
     *
     * @param string $title
     *
     * @return TicketType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ticket = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \Minegame\SupportBundle\Entity\Ticket $ticket
     *
     * @return TicketType
     */
    public function addTicket(\Minegame\SupportBundle\Entity\Ticket $ticket)
    {
        $this->ticket[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \Minegame\SupportBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\Minegame\SupportBundle\Entity\Ticket $ticket)
    {
        $this->ticket->removeElement($ticket);
    }

    /**
     * Get ticket
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}
