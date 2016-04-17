<?php

namespace GameBundle\Controller;

use GameBundle\Entity\TownRessource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\TownType;
use GameBundle\Entity\Town;

class TownController extends Controller
{
    public function indexAction()
    {
        $town = $this->getUser()->getTownCurrant();
        $ressources = $this->getDoctrine()->getRepository('GameBundle:Town')->getRessource($town->getId());
        return $this->render('GameBundle:Town:index.html.twig', array('title' => 'Vue générale du village', 'user' => $this->getUser(),
                                                                      'town' => $town, 'ressources' => $ressources));
    }

    public function addAction(Request $request) {
        $town = new Town();

        $form = $this->createForm(TownType::class, $town);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $town->setUser($this->getUser());
            $town->setPoint(0);
            $town->setHabitant(0);
            $town->setResident(0);
            $town->setX(0);
            $town->setY(0);
            $em->persist($town);
            $em->flush();

            $ressources = $this->getDoctrine()->getRepository('GameBundle:Ressource')->findAll();

            foreach($ressources as $r) {
                $tr = new TownRessource();
                $tr->setTown($town);
                $tr->setRessource($r);
                $tr->setAdd(0);
                $tr->setNb(0);
                $tr->setStock(0);
                $em->persist($tr);
                unset($tr);
            }

            $em->flush();

            return $this->redirectToRoute('game_homepage');
        }

        return $this->render('GameBundle:Town:form.html.twig', array('title' => 'Ajout d\'un village',
            'form' => $form->createView()));
    }

    public function choiceAction($id) {
        $town = $this->getDoctrine()->getRepository('GameBundle:Town')->findOneById($id);
        if($this->getUser() != $town->getUser()) {
            return $this->redirectToRoute('game_homepage');
        }
        else {
            $user = $this->getUser();
            $user->setTownCurrant($town);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('game_town');
        }
    }
}
