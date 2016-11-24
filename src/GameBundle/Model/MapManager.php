<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 17/11/16
 * Time: 21:13
 */

namespace GameBundle\Model;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MapManager
{
    private $em,
            $token;

    public function __construct(TokenStorageInterface $token, EntityManager $entityManager) {
        $this->token = $token;
        $this->em = $entityManager;
    }
}