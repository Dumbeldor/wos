<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\Building;
use GameBundle\Entity\BuildingRessource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\BuildingType;
use GameBundle\Form\BuildingRessourceType;

class BuildingRessourceController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/BuildingRessource:index.html.twig', array('title' => 'Gestion des ressource nécessaire pour les batiments'));
    }

    public function addAction(Request $request)
    {
        $building = new BuildingRessource();

        $form = $this->createForm(BuildingRessourceType::class, $building);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/BuildingRessource:form.html.twig', array('title' => 'Ajout de ressource nécessaire pour les batiments',
            'form' => $form->createView()));
    }

    public function listAction() {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingRessource')->getAll();
        return $this->render('GameBundle:Admin/BuildingRessource:list.html.twig', array('title' => 'Liste des batiments', 'ressources' => $building));
    }

    public function listIdAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingRessource')->getAllById($id);
        return $this->render('GameBundle:Admin/BuildingRessource:list.html.twig', array('title' => 'Liste des batiments', 'ressources' => $building));
    }

    public function editAction($id, Request $request) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingRessource')->find($id);

        $form = $this->createForm(BuildingRessourceType::class, $building);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/BuildingRessource:form.html.twig', array('title' => 'Edit de batiment',
            'form' => $form->createView()));
    }

}
