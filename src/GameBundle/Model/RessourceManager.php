<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GameBundle\Model;

use Doctrine\ORM\EntityManager;
use GameBundle\Entity\Town;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use GameBundle\Entity\Ressource;

class RessourceManager {
    private $em,
        $token;

    public function __construct(TokenStorageInterface $token, EntityManager $entityManager) {
        $this->token = $token;
        $this->em = $entityManager;
    }

    public function removeRessource(Town $town, $ressources) {
        $townRessource = $town->getRessources();
        echo "test";
        foreach($ressources as $r) {
            foreach($townRessource as $rT) {
                if($rT->getRessource()->getId() == $r->getRessource()->getId())
                    $rT->removeNb($r->getNb());
            }
        }
        //$town->setRessources($townRessource);
        $this->em->persist($town);
        $this->em->flush();
    }

}