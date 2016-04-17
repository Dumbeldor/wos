<?php

namespace AppBundle\EventListener;


use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use GameBundle\Entity\Town;
use GameBundle\Entity\TownRessource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManager;

class UserRegistrationSuccessListener implements EventSubscriberInterface
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $user = $event->getForm()->getData();


        $this->em->persist($user);
        $this->em->flush();
    }

}