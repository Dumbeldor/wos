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
        $test = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->exist($building, $this->getUser()->getTownCurrant());
        $requis = false;
        $exist = true;
        if(!$test) {
            $requis = true;
            $ressources = $this->getUser()->getTownCurrant()->getRessources();
            $i = 0;
            foreach ($building->getRessources() as $r) {
                if ($r->getNb() > $ressources[$i]->getNb()) {
                    $requis = false;
                    break;
                }
                $i++;
            }
            if ($building->getRequired()[0] AND $requis) {
                $nb = $this->getDoctrine()->getRepository('GameBundle:TownBuilding')->buildable($building->getRequired(), $this->getUser()->getTownCurrant());
                if ($nb == count($building->getRequired()))
                    $requis = true;
            } else {
                $requis = false;
            }
        }
        return $this->render('GameBundle:Building:viewSpecific.html.twig', array('title' => $building->getName(), 'user' => $this->getUser(),
            'building' => $building, 'requis' => $requis, 'exist' => $exist));
    }
}
