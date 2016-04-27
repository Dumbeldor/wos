<?php

namespace GameBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use GameBundle\Entity\BuildingRequired;
use GameBundle\Entity\InfantryTown;
use GameBundle\Entity\TownBuilding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BuildingController extends Controller
{
    public function indexAction() {
        $buildings = $this->getDoctrine()->getRepository('GameBundle:BuildingType')->getBuildings();
        return $this->render('GameBundle:Building:index.html.twig', array('title' => 'Listes des batiments',
                                                                    'buildings' => $buildings));
    }
    public function viewAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingType')->getBuilding($id);
        $townBuilding = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->getLvl($id, $this->getUser()->getTownCurrant()->getId());
        if(empty($townBuilding))
            echo "ooo";
        return $this->render('GameBundle:Building:view.html.twig', array('title' => '', 'user' => $this->getUser(),
            'building' => $building, 'townBuilding' => $townBuilding));
    }

    public function specificAction($id) {
        $requis = $this->isBuildable($id);
        var_dump($requis['exist']);
        var_dump($requis['requis']);
        return $this->render('GameBundle:Building:viewSpecific.html.twig', array('title' => $requis['building']->getName(), 'user' => $this->getUser(),
            'building' => $requis['building'], 'requis' => $requis['requis'], 'exist' => $requis['exist'], 'id' => $id));
    }

    public function buildAction($id) {
        $requis = $this->isBuildable($id);

       if(!$requis['requis'] OR $requis['exist'])
           return $this->redirectToRoute('game_town_building_view_specific', array('id' => $id));

        $townBuilding = new TownBuilding();
        $town = $this->getUser()->getTownCurrant();

        $building = $requis['building'];
        $townBuilding->setLvl($building->getLvl());
        $townBuilding->setBuilding($building);
        $townBuilding->setTown($this->getUser()->getTownCurrant());

        $buildingType = $building->getBuildingType();
        $isRessource = $buildingType->getIsRessource();
        $em = $this->getDoctrine()->getManager();

        if($isRessource) {
            $ressource = $this->getUser()->getTownCurrant()->getRessources();
            $idR = $buildingType->getRessource()->getId();
            foreach ($ressource AS $r) {
                if ($r->getRessource()->getId() == $idR) {
                    $ajout = $r->getAdd() + $building->getAdd();
                    $r->setAdd($ajout);
                    $em->persist($r);
                }
            }
        }
        else {

        }

        $town->addResident($building->getAddHabitant());
        $town->addPoint($building->getAddPoint());


        $em = $this->getDoctrine()->getManager();

        $em->persist($townBuilding);
        $em->persist($town);
        $em->flush();
        return $this->redirectToRoute('game_town_building_view_specific', array('id' => $id));
    }

    public function isBuildable($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuilding($id);
        $test = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->exist($id, $this->getUser()->getTownCurrant());
        $requis = false;
        $exist = true;

        if($test['nb'] < 1) {
            $exist = false;
            $requis = true;
            $ressources = $this->getUser()->getTownCurrant()->getRessources();
            $i = 0;
            foreach ($building->getRessources() as $r) {
                echo '<br>'.$r->getNb().' : '.$ressources[$i]->getNb();
                if ($r->getNb() > $ressources[$i]->getNb()) {
                    $requis = false;
                    break;
                }
                $i++;
            }
            if($requis AND count($building->getRequired()) == 0)
                $requis = true;
            else if ($building->getRequired()[0] AND $requis) {
                $nb = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->building($building->getRequired(), $this->getUser()->getTownCurrant());
                $requis = false;
                if ($nb == count($building->getRequired()))
                    $requis = true;
            } else {
                echo "ICI ?";
                $requis = false;
            }
        }
        return array('requis' => $requis, 'exist' => $exist, 'building' => $building);
    }
}
