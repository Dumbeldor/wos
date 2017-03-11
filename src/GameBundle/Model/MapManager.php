<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 17/11/16
 * Time: 21:13
 */

namespace GameBundle\Model;


use Doctrine\ORM\EntityManager;
use GameBundle\Entity\Town;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MapManager
{
    private $em,
            $token;

    public function __construct(TokenStorageInterface $token, EntityManager $entityManager) {
        $this->token = $token;
        $this->em = $entityManager;
    }

    public function placeTown(Town $town) {

    }
}