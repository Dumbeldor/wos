<?php

namespace Minegame\SupportBundle\Controller;

use Minegame\SupportBundle\Entity\Ticket;
use Minegame\SupportBundle\Entity\TicketMessage;
use Minegame\SupportBundle\Form\TicketMessageType;
use Minegame\SupportBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $tickets = $this->getDoctrine()->getRepository("MinegameSupportBundle:Ticket")->getTickets($this->getUser());
        return $this->render('MinegameSupportBundle:Default:index.html.twig', array('title' => 'Support', 'tickets' => $tickets));
    }

    public function addAction(Request $request)
    {
        $ticket = new Ticket();
        $ticket->setUser($this->getUser());
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();
            $this->redirectToRoute('minegame_support_homepage');
        }

        return $this->render('MinegameSupportBundle:Default:add.html.twig', array('title' => 'Support | Ajout ticket',
                                                                            'form' => $form->createView()));
    }

    public function responseAction(Ticket $ticket, Request $request)
    {
        $ticketMessage = new TicketMessage();
        $ticketMessage->setUser($this->getUser());
        $ticketMessage->setTicket($ticket);
        $form = $this->createForm(TicketMessageType::class, $ticketMessage);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticketMessage);
            $em->flush();
        }

        return $this->render('MinegameSupportBundle:Default:response.html.twig', array('title' => 'Support | Réponse ticket',
                                                'ticket' => $ticket, 'form' => $form->createView()));
    }
}
