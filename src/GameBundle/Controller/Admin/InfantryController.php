<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\Infantry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\InfantryType;

class InfantryController extends Controller
{
    public function indexAction()
    {
        //echo $this->container->getParameter('academie');
        return $this->render('GameBundle:Admin/Infantry:index.html.twig', array('title' => 'Gestion des unités'));
    }

    public function addAction(Request $request)
    {
        $infantry = new Infantry();

        $form = $this->createForm(InfantryType::class, $infantry);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infantry);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Infantry:form.html.twig', array('title' => 'Ajout d\'unité',
            'form' => $form->createView()));
    }

    public function listAction() {
        $infantry = $this->getDoctrine()->getRepository('GameBundle:Infantry')->findAll();
        return $this->render('GameBundle:Admin/Infantry:list.html.twig', array('title' => 'Liste des batiments', 'infantrys' => $infantry));
    }

    public function editAction($id, Request $request) {
        $infantry = $this->getDoctrine()->getRepository('GameBundle:Infantry')->find($id);

        $form = $this->createForm(InfantryType::class, $infantry);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infantry);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Infantry:form.html.twig', array('title' => 'Edit des unités',
            'form' => $form->createView()));
    }
}
