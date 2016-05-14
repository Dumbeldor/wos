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
        $infantry = $this->getDoctrine()->getRepository('GameBundle:Infantry')->ifInBuilding($id);
        $townBuilding = $this->container->get('game.building_manager')->getLvlByType($id, $this->getUser()->getTownCurrant()->getId());

        return $this->render('GameBundle:Building:view.html.twig', array('title' => '', 'user' => $this->getUser(),
            'building' => $building, 'townBuilding' => $townBuilding, 'infantry' => $infantry));
    }

    public function specificAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuilding($id);
        $this->container->get('game.building_manager')->getBuildingInBuild($building->getBuildingType());
        $buildingBuild = $this->getDoctrine()->getRepository('GameBundle:BuildingBuild')->getBuilding($id);
        $requis = $this->container->get('game.building_manager')->isBuildable($building, $this->getUser()->getTownCurrant());

        return $this->render('GameBundle:Building:viewSpecific.html.twig', array('title' => $building->getName(), 'user' => $this->getUser(),
            'building' => $building, 'requis' => $requis, 'exist' => false, 'id' => $id, 'buildingBuild' => $buildingBuild));
    }

    public function buildAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuilding($id);

       if(!$this->container->get('game.building_manager')->build($building, $this->getUser()->getTownCurrant()))
           return $this->redirectToRoute('game_town_building_view_specific', array('id' => $id));

        $this->container->get('game.ressource_manager')->removeRessource($this->getUser()->getTownCurrant(), $building->getRessources());

        return $this->redirectToRoute('game_town_building_view_specific', array('id' => $id));
    }
}
