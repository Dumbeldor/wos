<?php
namespace GameBundle\Model;

use Doctrine\ORM\EntityManager;
use GameBundle\Entity\InfantryBuild;
use GameBundle\Entity\Infantry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class InfantryManager{
    private $em,
            $token;

    public function __construct(TokenStorageInterface $token, EntityManager $entityManager) {
        $this->token = $token;
        $this->em = $entityManager;
    }

    public function getInfantryBuild(Infantry $infantry) {
        $infantryBuild = $this->em->getRepository('GameBundle:InfantryBuild')->findOneByInfantry($infantry->getId());

        if($infantryBuild instanceof InfantryBuild) {
            $timeForm = $infantry->getTime() * 60;
            $timeBegin = $infantryBuild->getBeginFormation();
            $diffTime = time() - $timeBegin;

            if ($diffTime >= $timeForm) {
                $townId =$this->token->getToken()->getUser()->getTownCurrant();
                $toCreate = floor($diffTime/$timeForm);
                echo "Fin de formation";
                echo "<br> time formation ; $timeForm";
                echo "<br> diff : " . $diffTime;
                echo "<br> Unité a créer : ".$diffTime/$timeForm;

                $infantryBuild->setNb($infantryBuild->getNb() - $toCreate);

                $this->em->getRepository('GameBundle:InfantryBuild')->createInfantry($infantry->getId(), $toCreate, $townId);
                $this->em->getRepository('GameBundle:InfantryTown')->createInfantry($infantry->getId(), $toCreate, $townId);
            }
        }

        return $infantryBuild;
    }
}