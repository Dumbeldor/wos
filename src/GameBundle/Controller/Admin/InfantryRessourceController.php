<?php
/**
 * This file is part of the World Of Shinobi (Minegame).
 *
 * Copyright (c) 2017. Vincent Glize <vincent.glize@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GameBundle\Controller\Admin;

use GameBundle\Entity\InfantryRessource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InfantryRessourceController extends Controller
{
    public function addAction($id, Request $request) {
        $infantryRessource = new InfantryRessource();
        $infantry = $this->getDoctrine()->getRepository('GameBundle:Infantry')->findOneById($id);
        $infantryRessource->setInfantry($infantry);

        $form = $this->createFormBuilder($infantryRessource)
            ->add('nb', IntegerType::class, array('label' => 'Ressource nécessaire'))
            ->add('ressource', EntityType::class, array(
                'class' => 'GameBundle:Ressource',
                'choice_label' => 'name'
            ))
            ->getForm();
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infantryRessource);
            $em->flush();
            if($infantry->getId() != $id)
                return $this->redirectToRoute('game_admin_infantry_ressource_add', array('id' => $infantry->getId()));
        }

        return $this->render('GameBundle:Admin/InfantryRessource:form.html.twig', array('title' => 'Ajout de ressource pour '.$infantry->getName(),
            'infantryRessource' => $infantryRessource,
            'infantry' => $infantry,
            'form' => $form->createView()));
    }


}