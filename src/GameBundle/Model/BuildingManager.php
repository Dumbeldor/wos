<?php
namespace GameBundle\Model;

use Doctrine\ORM\EntityManager;

use GameBundle\Entity\BuildingBuild;
use GameBundle\Entity\Building;
use GameBundle\Entity\BuildingType;
use GameBundle\Entity\Town;
use GameBundle\Entity\TownBuilding;
use GameBundle\Entity\TownRessource;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BuildingManager{
    private $em,
        $token;

    public function __construct(TokenStorageInterface $token, EntityManager $entityManager) {
        $this->token = $token;
        $this->em = $entityManager;
    }

    public function getLvlByType($idType, $idTown) {
        return $this->em->getRepository('GameBundle:TownBuilding')->getLvl($idType, $idTown);
    }

    public function getLvlByName($name, $idTown) {
        return $this->em->getRepository('GameBundle:TownBuilding')->getLvlByName($name, $idTown);
    }

    public function getBuildingInBuild(BuildingType $buildingType, $town) {
        $town = $this->token->getToken()->getUser()->getTownCurrant();
        $buildingBuild = $this->em->getRepository('GameBundle:BuildingBuild')->findOneBy(array('buildingType' => $buildingType, 'town'=>$town));
        if($buildingBuild instanceof BuildingBuild){
            if($buildingBuild->getEndBuild() <= time()) {
                $townBuilding = $this->em->getRepository('GameBundle:TownBuilding')->findOneBy(array('buildingType' => $buildingType, 'town' => $town));
                if(!$townBuilding instanceof TownBuilding) {
                    $townBuilding = new TownBuilding();
                    $townBuilding->setBuildingType($buildingType);
                    $townBuilding->setBuilding($buildingBuild->getBuilding());
                    $townBuilding->setLvl($buildingBuild->getBuilding()->getLvl());
                    $townBuilding->setTown($town);
                } else {
                    $townBuilding->setBuilding($buildingBuild->getBuilding());
                    $townBuilding->setLvl($buildingBuild->getBuilding()->getLvl());
                }

                //Si c'est un batiment de ressource
                if($buildingType->getIsRessource()) {
                    $ressource = $town->getRessources();
                    foreach($ressource as $r) {
                        if($r->getRessource()->getId() == $buildingType->getRessource()->getId()) {
                            $r->addAdd($buildingBuild->getBuilding()->getAdd());
                            echo $r->getAdd();
                            $this->em->persist($r);
                        }
                    }
                }

                $this->em->persist($townBuilding);
                $this->em->remove($buildingBuild);
                $this->em->flush();

            }
        }
    }

    public function isBuildable($building, $town) {
        $test = $this->em->getRepository('GameBundle:TownBuilding')->exist($building, $town);

        if($test['nb'] > 0)
            return false;

        $ressourcesTown = $town->getRessources();
        $i = 0;
        foreach($building->getRessources() as $r) {
            if($r->getNb() > $ressourcesTown[$i]->getNb())
                return false;
            $i++;
        }

        //Si le batiment a des batiments requis pour être construit
        if(count($building->getRequired()) > 0) {
            //var_dump($building->getRequired());
            $nb = $this->em->getRepository('GameBundle:TownBuilding')->building($building->getRequired(), $this->token->getToken()->getUser()->getTownCurrant());
            if($nb == count($building->getRequired()))
                return true;
            return false;
        } else {
            return true;
        }

        return false;
    }

    public function build(Building $building, Town $town)
    {
        if (!$this->isBuildable($building, $town))
            return false;

        $buildingBuild = $this->em->getRepository('GameBundle:BuildingBuild')->findOneByBuilding($building);

        if (!$buildingBuild instanceof BuildingBuild) {
            $buildingBuild = new BuildingBuild();
            $buildingBuild->setTown($town);
            $buildingBuild->setBuilding($building);
            $buildingBuild->setBuildingType($building->getBuildingType());
            $buildingBuild->setEndBuild(time() + ($building->getTime() * 60));

            $this->em->persist($buildingBuild);
            $this->em->flush();
        }
        return true;
    }
}