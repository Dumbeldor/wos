<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// src/GameBundle/DataFixtures/ORM/LoadUser.php

namespace GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GameBundle\Entity\Map;

class LoadMap implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        $map = array();
        $list = array();

        for ($x=0; $x < 50; $x++) {
            for ($y=0; $y < 50; $y++) {
                $map = array('x' => $x, 'y' => $y);
                array_push($list, $map);
            }
        }
        $list = array($map);

        foreach ($list as $names) {
            $map = new Map();
            $map->setX($names['x']);
            $map->setY($names['y']);

            $manager->persist($map);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
