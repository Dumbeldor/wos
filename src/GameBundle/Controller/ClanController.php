<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Clan;
use GameBundle\Entity\ClanUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\ClanType;

class ClanController extends Controller
{
    public function indexAction(Request $request) {
        $building = $this->container->get('game.building_manager')->getLvlByName('Haut conseil', $this->getUser()->getTownCurrant()->getId());
        //$clan = $this->getDoctrine()->getRepository('GameBundle:Clan')->findOneById($this->getUser()->getClan()->getClan()->getId());
        $clan = new Clan();
        $form = $this->createFormBuilder($clan)
            ->add('name')
            ->getForm();
        $form->handleRequest($request);

        //Recherche
        if($form->isValid()) {
            $clans = $this->getDoctrine()->getRepository('GameBundle:Clan')->findByName($clan->getName());
            return $this->render('GameBundle:Clan:list.html.twig', array('title' => 'Recherche clan '.$clan->getName(), 'clans' => $clans));
        }
        return $this->render('GameBundle:Clan:index.html.twig', array('title' => 'Clan', 'clan' => $this->getUser()->getClan(),
            'building' => $building, 'form' => $form->createView()));
    }

    public function listAction() {
        $clans = $this->getDoctrine()->getRepository('GameBundle:Clan')->getList();
        return $this->render('GameBundle:Clan:list.html.twig', array('title' => 'Liste clan ', 'clans' => $clans));
    }

    public function createAction(Request $request) {
        $clan = $this->getUser()->getClan();
        $building = $this->container->get('game.building_manager')->getLvlByName('Haut conseil', $this->getUser()->getTownCurrant()->getId());
        if($building->getLvl() >= 3 AND !($clan instanceof Clan)) {
            $clan = new Clan();
            $form = $this->createForm(ClanType::class, $clan);
            $form->handleRequest($request);

            if($form->isValid()) {
                $clan->setPoint(0);
                $clan->setXp(0);
                $clanUser = new ClanUser();
                $clanUser->setClan($clan);
                $clanUser->setRank($this->getDoctrine()->getRepository('GameBundle:ClanRank')->findOneById(1));
                $clanUser->setUser($this->getUser());

                $this->getUser()->setClan($clanUser);
                $em = $this->getDoctrine()->getManager();
                $em->persist($clan);
                $em->persist($clanUser);
                $em->flush();
                return $this->redirectToRoute('game_haut_conseil');
            }
            return $this->render('GameBundle:Clan:create.html.twig', array('title' => 'Création clan', 'form' => $form->createView()));
        }
    }

    public function infoAction($id) {
        $clan = $this->getDoctrine()->getRepository('GameBundle:Clan')->getClan($id);
        return $this->render('GameBundle:Clan:info.html.twig', array('title' => 'Info clan', 'clan' => $clan));
    }
}