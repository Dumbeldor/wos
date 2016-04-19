<?php

namespace GameBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BuildingController extends Controller
{
    public function viewAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingType')->getBuilding($id);
        $townBuilding = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->getBuilding($id);
        return $this->render('GameBundle:Building:view.html.twig', array('title' => $building->getName(), 'user' => $this->getUser(),
            'building' => $building, 'townBuilding' => $townBuilding));
    }

    public function specificAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuilding($id);
        $townBuilding = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->getBuilding($id);
        return $this->render('GameBundle:Building:viewSpecific.html.twig', array('title' => $building->getName(), 'user' => $this->getUser(),
            'building' => $building, 'townBuilding' => $townBuilding));
    }
}
