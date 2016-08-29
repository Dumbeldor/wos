<?php
namespace GameBundle\Model;

use Doctrine\ORM\EntityManager;
use GameBundle\Entity\InfantryBuild;
use GameBundle\Entity\Infantry;
use GameBundle\Entity\InfantryTown;
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

        if($infantryBuild instanceof InfantryBuild AND $infantryBuild->getNb() >= 0) {
            $timeForm = $infantry->getTime() * 60;
            $timeBegin = $infantryBuild->getBeginFormation();
            $diffTime = time() - $timeBegin;

            if ($diffTime >= $timeForm) {
		echo "Formation terminé";
                $townId =$this->token->getToken()->getUser()->getTownCurrant();
                $toCreate = floor($diffTime/$timeForm);

                if($toCreate > $infantryBuild->getNb())
                    $toCreate = $infantryBuild->getNb();

                $infantryBuild->setNb($infantryBuild->getNb() - $toCreate);
		echo "<br>Le nombre : $toCreate <br>";
		echo "testatest<br>";

                $this->em->getRepository('GameBundle:InfantryBuild')->createInfantry($infantry->getId(), $toCreate, $townId);
                $nb = $this->em->getRepository('GameBundle:InfantryTown')->findBy(array('town' => $townId, 'infantry' => $infantry->getId()));

                if(count($nb) > 0) {
                    $this->em->getRepository('GameBundle:InfantryTown')->addInfantry($infantry->getId(), $toCreate, $townId);
                } else {
                    $infantryTown = new InfantryTown();
                    $infantryTown->setInfantry($infantry);
                    $infantryTown->setTown($townId);
                    $infantryTown->setNb($toCreate);
                    $this->em->persist($infantryTown);
                    $this->em->flush();
                }
            }
            echo "ooo";
            return $infantryBuild;
        }
        $infantryBuild = new InfantryBuild();
        $infantryBuild->setNb(0);
        $infantryBuild->setTown($this->token->getToken()->getUser()->getTownCurrant());
        $infantryBuild->setInfantry($infantry);
        return $infantryBuild;
    }

    public function ifBuildable(Infantry $infantry, $nb) {
        $ressourceNecessaire = $infantry->getRessources();
        $ressourceDispo = $this->token->getToken()->getUser()->getTownCurrant()->getRessources();

        $i = 0;
        foreach($ressourceNecessaire as $r) {
            echo $r->getNb().' : '.$ressourceDispo[$i]->getNb().'<br>';
            if($r->getNb() * $nb > $ressourceDispo[$i]->getNb()){
                return false;
            }
            $i++;
        }

        $i = 0;
        foreach($ressourceNecessaire as $r) {
            $ressourceDispo[$i]->removeNb($r->getNb() * $nb);
            $this->em->persist($ressourceDispo[$i]);
            $i++;
        }
        $this->em->flush();


        return true;
    }
}
