<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\Building;
use GameBundle\Entity\BuildingRessource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\BuildingType;
use GameBundle\Form\BuildingRessourceType;

class BuildingController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/Building:index.html.twig', array('title' => 'Gestion des batiments'));
    }

    public function addAction(Request $request)
    {
        $building = new Building();

        $form = $this->createForm(BuildingType::class, $building);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
            return $this->redirectToRoute('game_admin_building_ressource_add_id', array('id' => $building->getId()));
        }

        return $this->render('GameBundle:Admin/Building:form.html.twig', array('title' => 'Ajout de batiment',
            'form' => $form->createView()));
    }

    public function listAction() {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuildings();
        return $this->render('GameBundle:Admin/Building:list.html.twig', array('title' => 'Liste des batiments', 'buildings' => $building));
    }

    public function listByTypeAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuildingsByType($id);
        return $this->render('GameBundle:Admin/Building:list.html.twig', array('title' => 'Liste des batiments', 'buildings' => $building));
    }

    public function editAction($id, Request $request) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->find($id);

        $form = $this->createForm(BuildingType::class, $building);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
            return $this->redirectToRoute('game_admin_building_ressource_add_id', array('id' => $building->getId()));
        }

        return $this->render('GameBundle:Admin/Building:form.html.twig', array('title' => 'Edit de batiment',
            'form' => $form->createView()));
    }

    public function editRessourceAction($id, Request $request) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->find($id);
        $ressource = new BuildingRessource();

        $form = $this->createForm(BuildingRessourceType::class, $ressource);
        $form->handleRequest($request);

        if($form->isValid()) {
            $ressource->setBuilding($building);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Building:formRessource.html.twig', array('title' => 'Edit de batiment',
            'form' => $form->createView()));
    }
}
