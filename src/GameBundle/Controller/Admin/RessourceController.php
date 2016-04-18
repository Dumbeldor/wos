<?php

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\Ressource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\RessourceType;

class RessourceController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/Ressource:index.html.twig', array('title' => 'Gestion ressources'));
    }

    public function addAction(Request $request)
    {
        $ressource = new Ressource();

        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Ressource:form.html.twig', array('title' => 'Ajout de ressource',
                                                                            'form' => $form->createView()));
    }

    public function listAction() {
        $ressources = $this->getDoctrine()->getRepository('GameBundle:Ressource')->findAll();
        return $this->render('GameBundle:Admin/Ressource:list.html.twig', array('title' => 'Liste ressources', 'ressource' => $ressources));
    }

    public function editAction($id, Request $request) {
        $ressource = $this->getDoctrine()->getRepository('GameBundle:Ressource')->find($id);

        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();
        }

        return $this->render('GameBundle:Admin/Ressource:form.html.twig', array('title' => 'Edit de ressource',
            'form' => $form->createView()));
    }
}
