<?php
namespace GameBundle\Model;

use Doctrine\ORM\EntityManager;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BuildingManager{
    private $em,
        $token;

    public function __construct(TokenStorageInterface $token, EntityManager $entityManager) {
        $this->token = $token;
        $this->em = $entityManager;
    }

   public function get
}