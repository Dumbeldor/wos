<?php

namespace GameBundle\Controller;


use GameBundle\Entity\BuildingRequired;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BuildingController extends Controller
{
    public function viewAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingType')->getBuilding($id);
        $townBuilding = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->getLvl($id);
        return $this->render('GameBundle:Building:view.html.twig', array('title' => '', 'user' => $this->getUser(),
            'building' => $building, 'townBuilding' => $townBuilding));
    }

    public function specificAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuilding($id);
        $requis = false;
        if($building->getRequired()[0]) {
            $nb = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->exist($building->getRequired(), $this->getUser()->getTownCurrant());
            if($nb == count($building->getRequired()))
                $requis = true;
        }
        return $this->render('GameBundle:Building:viewSpecific.html.twig', array('title' => $building->getName(), 'user' => $this->getUser(),
            'building' => $building, 'requis' => $requis));
    }
}
