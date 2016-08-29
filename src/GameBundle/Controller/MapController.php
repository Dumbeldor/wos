<?php

namespace GameBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Entity\Map;

class MapController extends Controller
{
    public function indexAction(Request $request) {
        $position = $this->getUser()->getTownCurrant()->getMap();
        $map = $this->getDoctrine()->getRepository('GameBundle:Map')->getMapByPosition($position);
        return $this->render('GameBundle:Map:index.html.twig', array('title' => 'Map',
            'position' => $position, 'map' => $map));
    }
}