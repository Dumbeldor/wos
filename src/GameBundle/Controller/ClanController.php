<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Clan;
use GameBundle\Entity\ClanDiplomatyCandidature;
use GameBundle\Entity\ClanDiplomaty;
use GameBundle\Entity\ClanUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Form\ClanType;
use GameBundle\Form\ClanCandidatureType;
use GameBundle\Form\ClanDiplomatyCandidatureType;

class ClanController extends Controller
{
    public function indexAction(Request $request) {
        $building = $this->container->get('game.building_manager')->getLvlByName('Haut conseil', $this->getUser()->getTownCurrant()->getId());

        $clanForm = new Clan();
        $clan = $this->getUser()->getClan();
        if($clan instanceof ClanUser)
            $clan = $this->getDoctrine()->getRepository('GameBundle:Clan')->getClan($clan->getClan()->getId());
        else
            $clan = new Clan();

        $form = $this->createFormBuilder($clanForm)
            ->add('name')
            ->getForm();
        $form->handleRequest($request);

        //Recherche
        if($form->isValid()) {
            $clans = $this->getDoctrine()->getRepository('GameBundle:Clan')->findByName($clanForm->getName());
            return $this->render('GameBundle:Clan:list.html.twig', array('title' => 'Recherche clan '.$clanForm->getName(), 'clans' => $clans));
        }
        return $this->render('GameBundle:Clan:index.html.twig', array('title' => 'Clan', 'clan' => $clan,
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
        $clan = $this->getDoctrine()->getRepository('GameBundle:Clan')->getClanInfoForUser($id, $this->getUser()->getId());
        return $this->render('GameBundle:Clan:info.html.twig', array('title' => 'Info clan', 'clan' => $clan, 'myClan' => $this->getUser()->getClan()));
    }

    public function candidatureAction($id, Request $request) {
        $clan = $this->getDoctrine()->getRepository('GameBundle:Clan')->getName($id);
        $clanCandidature = new ClanCandidature();
        $form = $this->createForm(ClanCandidatureType::class, $clanCandidature);
        $form->handleRequest($request);

        if($form->isValid()) {
            $clanCandidature->setUser($this->getUser());
            $clanCandidature->setClan($clan);
            $em = $this->getDoctrine()->getManager();
            $em->persist($clanCandidature);
            $em->flush();
            return $this->redirectToRoute('game_clan_info', array('id' => $id));
        }
        return $this->render('GameBundle:Clan:candidature.html.twig', array('title' => 'Candidature clan', 'clan' => $clan,
                                                'form' => $form->createView()));
    }

    public function acceptCandidatureAction(ClanCandidature $cc) {
        $clan = $cc->getClan();
        $clanUser = new ClanUser();
        $clanUser->setClan($clan);
        $clanUser->setUser($cc->getUser());
        $clanUser->setRank($this->getDoctrine()->getRepository('GameBundle:ClanRank')->findOneById(2));

        $this->getDoctrine()->getRepository('GameBundle:ClanCandidature')->acccept($cc->getUser()->getId());

        $clan->addUser($clanUser);

        $em = $this->getDoctrine()->getManager();
        $em->persist($clan);
        $em->persist($clanUser);
        $em->flush();
        return $this->redirectToRoute('game_haut_conseil');
    }

    public function refuseCandidatureAction(ClanCandidature $cc) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cc);
        $em->flush();
    }

    public function diplomatyListAction() {
        $ally = $this->getDoctrine()->getRepository('GameBundle:ClanDiplomaty')->getAlly($this->getUser()->getClan()->getClan());
        //$ally = $this->getUser()->getClan()->getClan()->getAlly();
        return $this->render('GameBundle:Clan:allyList.html.twig', array('title' => 'Clan allié', 'ally' => $ally));
    }

    public function allyAddAction($id) {

    }

    public function diplomatyCandidatureAction(Clan $clan, Request $request) {
        $clanAC = new ClanDiplomatyCandidature();
        $form = $this->createForm(ClanDiplomatyCandidatureType::class, $clanAC);
        $form->handleRequest($request);

        if($form->isValid()) {
            $clanAC->setClanCible($clan);
            $clanAC->setClanSource($this->getUser()->getClan()->getClan());
            $em = $this->getDoctrine()->getManager();
            $em->persist($clanAC);
            $em->flush();
        }

        return $this->render('GameBundle:Clan:allyCandidature.html.twig', array('title' => 'Clan allié', 'clan' => $clan,
            'form' => $form->createView()));
    }

    public function diplomatyAcceptAction(ClanDiplomatyCandidature $clanAllyC) {
        $clanB = $clanAllyC->getClanSource();
        $clanA = $this->getUser()->getClan()->getClan();

        $clanDiplomatyB = new ClanDiplomaty();
        $clanDiplomatyA = new ClanDiplomaty();

        $clanDiplomatyB->setDiplomaty($clanAllyC->getDiplomaty());
        $clanDiplomatyB->setClanSource($clanB);
        $clanDiplomatyB->setClanCible($clanA);

        $clanDiplomatyA->setDiplomaty($clanAllyC->getDiplomaty());
        $clanDiplomatyA->setClanSource($clanA);
        $clanDiplomatyA->setClanCible($clanB);

        $em = $this->getDoctrine()->getManager();
        $em->persist($clanDiplomatyB);
        $em->persist($clanDiplomatyA);
        $em->remove($clanAllyC);
        $em->flush();
        return $this->redirectToRoute('game_haut_conseil');
    }

    public function diplomatyRefuseAction(ClanDiplomatyCandidature $clanAllyC) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($clanAllyC);
        $em->flush();
        return $this->redirectToRoute('game_haut_conseil');
    }
}