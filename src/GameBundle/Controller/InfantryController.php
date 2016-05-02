<?php

namespace GameBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use GameBundle\Entity\InfantryTown;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InfantryController extends Controller
{
    public function academieAction(Request $request)
    {
        $infantry = new InfantryTown();
        $genin = $this->getDoctrine()->getRepository('GameBundle:Infantry')->findOneById(1);
        $infantry->setTown($this->getUser()->getTownCurrant());
        $infantry->setInfantry($genin);
        $nb = $this->getDoctrine()->getRepository('GameBundle:TownInfantry')->nb(1);

        $form = $this->createFormBuilder($infantry)
            ->add('nb', IntegerType::class, array('label' => 'Nombre'))
            ->getForm();;

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infantry);
            $em->flush();
        }

        return $this->render('GameBundle:Building:academie.html.twig', array('title' => 'Recrutement Genin',
            'form' => $form->createView(), 'nb' => $nb, 'genin' => $genin));
    }
}