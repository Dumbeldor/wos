<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\BuildingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\BuildingTypeType;

class BuildingTypeController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/BuildingType:index.html.twig', array('title' => 'Gestion des Type nécessaire pour les batiments'));
    }

    public function addAction(Request $request)
    {
        $buildingType = new BuildingType();

        $form = $this->createForm(BuildingTypeType::class, $buildingType);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($buildingType);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/BuildingType:form.html.twig', array('title' => 'Ajout de Type nécessaire pour les batiments',
            'edit' => false,'form' => $form->createView()));
    }

    public function listAction() {
        $buildingType = $this->getDoctrine()->getRepository('GameBundle:BuildingType')->findAll();
        return $this->render('GameBundle:Admin/BuildingType:list.html.twig', array('title' => 'Liste des batiments', 'buildingTypes' => $buildingType));
    }
/*
    public function listIdAction($id) {
        $buildingType = $this->getDoctrine()->getRepository('GameBundle:buildingType')->getAllById($id);
        return $this->render('GameBundle:Admin/buildingType:list.html.twig', array('title' => 'Liste des batiments', 'Types' => $buildingType));
    }
*/
    public function editAction($id, Request $request) {
        $buildingType = $this->getDoctrine()->getRepository('GameBundle:BuildingType')->find($id);

        $form = $this->createForm(buildingTypeType::class, $buildingType);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($buildingType);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/BuildingType:form.html.twig', array('title' => 'Edit de batiment',
            'form' => $form->createView(), 'edit' => true, 'buildingType' => $buildingType));
    }

}
