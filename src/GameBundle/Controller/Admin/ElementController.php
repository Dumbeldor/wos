<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\Element;
use GameBundle\Form\ElementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ElementController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/Element:index.html.twig', array('title' => 'Gestion des Elements'));
    }

    public function addAction(Request $request)
    {
        $element = new Element();

        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Element:form.html.twig', array('title' => 'Ajout d\'un élément',
            'form' => $form->createView()));
    }

    public function listAction() {
        $element = $this->getDoctrine()->getRepository('GameBundle:Element')->findAll();
        return $this->render('GameBundle:Admin/Element:list.html.twig', array('title' => 'Liste des éléments', 'elements' => $element));
    }

    public function editAction($id, Request $request) {
        $element = $this->getDoctrine()->getRepository('GameBundle:Element')->find($id);

        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Element:form.html.twig', array('title' => 'Edit des éléments',
            'form' => $form->createView()));
    }
}