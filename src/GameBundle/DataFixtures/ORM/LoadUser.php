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
use AppBundle\Entity\User;
use GameBundle\Entity\Town;

class LoadUser implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $list = array(
        array('name' => 'admin', 'email' => 'admin@mail', 'town' => 'Vivi1', 'role' => 'ROLE_ADMIN'),
        array('name' => 'Joueur1', 'email' => 'joueur1@mail', 'town' => 'Vivi1', 'role' => 'ROLE_USER'),
        array('name' => 'Joueur2', 'email' => 'joueur2@mail', 'town' => 'Vivi1', 'role' => 'ROLE_USER'),
        array('name' => 'Joueur3', 'email' => 'joueur3@mail', 'town' => 'Vivi1', 'role' => 'ROLE_USER'),
        array('name' => 'Joueur4', 'email' => 'joueur4@mail', 'town' => 'Vivi1', 'role' => 'ROLE_USER'),
        array('name' => 'Joueur5', 'email' => 'joueur5@mail', 'town' => 'Vivi1', 'role' => 'ROLE_USER')
        );

    foreach ($list as $names) {
        $user = new user();
        $user->setUsername($names['name']);
        $user->setEmail($names['email']);
        $user->setEnabled(true);
        $salt = array($user->getSalt());
        $user->setPassword(password_hash('test', PASSWORD_BCRYPT, $salt));
        $user->addRole($names['role']);

        $town = new town();
        $town->setName($names['town']);
        $town->setResident(0);
        $town->setPoint(0);
        $town->setX(0);
        $town->setY(0);
        $town->setUser($user);

        $user->setTownCurrant($town);

        // On les persistes
        $manager->persist($town);
        $manager->persist($user);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}
