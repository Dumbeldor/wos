<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\BuildingRequired;
use GameBundle\Form\BuildingRequiredType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BuildingRequiredController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/BuildingRequired:index.html.twig', array('title' => 'Gestion des batiments'));
    }

    public function viewAction($id) {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->findOneById($id);
        //$buildingRequired = $this->getDoctrine()->getRepository('GameBundle:BuildingRequired')->findBy($id);
        return $this->render('GameBundle:Admin/BuildingRequired:view.html.twig', array('title' => 'Gestion des requis pour batiments',
                                                                                        'building' => $building));
    }

    public function addAction($id, Request $request)
    {
        $building = $this->getDoctrine()->getRepository('GameBundle:Building')->getBuilding($id);
        $buildingRequired = new BuildingRequired();
        $buildingRequired->setBuildingChild($building);

        $form = $this->createForm(BuildingRequiredType::class, $buildingRequired);
        $form->handleRequest($request);

        if($form->isValid()) {
            $buildingRequired->setLvl(0);
            $building->addRequired($buildingRequired);
            $em = $this->getDoctrine()->getManager();
            $em->persist($buildingRequired);
            $em->persist($building);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/BuildingRequired:form.html.twig', array('title' => 'Ajout de batiment requis pour construire '.$building->getName(),
            'form' => $form->createView(), 'building' => $building));
    }

    public function deleteAction($idBat, $idBuild) {
        $buildingRequired = $this->getDoctrine()->getRepository('GameBundle:BuildingRequired')->findOneById($idBuild);
        $em = $this->getDoctrine()->getManager();
        $em->remove($buildingRequired);
        $em->flush();
        return $this->redirectToRoute('game_admin_building_required_view', array('id' => $idBat));
    }

    public function listAction() {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingRequired')->findAll();
        return $this->render('GameBundle:Admin/BuildingRequired:list.html.twig', array('title' => 'Liste des requis batiment', 'buildings' => $building));
    }

    public function editAction($id, Request $request) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingRequired')->find($id);

        $form = $this->createForm(BuildingRequiredType::class, $building);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Building:form.html.twig', array('title' => 'Edit de batiment',
            'form' => $form->createView()));
    }

    public function editRessourceAction($id, Request $request) {
        $building = $this->getDoctrine()->getRepository('GameBundle:BuildingRequired')->find($id);
        $ressource = new BuildingRequired();

        $form = $this->createForm(BuildingRequiredType::class, $ressource);
        $form->handleRequest($request);

        if($form->isValid()) {
            $ressource->setBuilding($building);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/BuildingRequired:formRessource.html.twig', array('title' => 'Edit de batiment',
            'form' => $form->createView()));
    }
}
