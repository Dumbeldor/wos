<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;


use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use GameBundle\Entity\Town;
use GameBundle\Entity\TownRessource;
use GameBundle\Entity\Ressource;
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
        $town = $user->getTownCurrant();

        $ressources = $this->em->getRepository('GameBundle:Ressource')->findAll();

        foreach($ressources as $r) {
            $townR = new TownRessource();
            $townR->setRessource($r);
            $townR->setNb(400);
            $townR->setAdd(0);
            $townR->setStock(0);
            $townR->setTown($town);

            $this->em->persist($townR);
            unset($townR);
        }


            $this->em->persist($user);
        $town->setResident(0);
        $town->setPoint(0);
        $town->setUser($user);
        $this->em->persist($town);


            $this->em->flush();
        }

}
