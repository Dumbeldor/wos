<?php

namespace Minegame\SupportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketMessage
 *
 * @ORM\Table(name="ticket_message")
 * @ORM\Entity(repositoryClass="Minegame\SupportBundle\Repository\TicketMessageRepository")
 */
class TicketMessage
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
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Minegame\SupportBundle\Entity\Ticket", inversedBy="messages")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    private $ticket;


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
     * Set message
     *
     * @param string $message
     *
     * @return TicketMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return TicketMessage
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
     * Set ticket
     *
     * @param \Minegame\SupportBundle\Entity\Ticket $ticket
     *
     * @return TicketMessage
     */
    public function setTicket(\Minegame\SupportBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Minegame\SupportBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
