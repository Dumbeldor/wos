<?php

namespace GameBundle\Controller;


use GameBundle\Entity\InfantryBuild;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use GameBundle\Entity\InfantryTown;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InfantryController extends Controller
{
    public function academieAction(Request $request)
    {
        $infantryBuild = new InfantryBuild();
        $genin = $this->getDoctrine()->getRepository('GameBundle:Infantry')->findOneById(1);
        $infantryBuild->setTown($this->getUser()->getTownCurrant());
        $infantryBuild->setInfantry($genin);
        $nb = $this->getDoctrine()->getRepository('GameBundle:TownInfantry')->nb(1);

        $form = $this->createFormBuilder($infantryBuild)
            ->add('nb', IntegerType::class, array('label' => 'Nombre'))
            ->getForm();;

        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($infantryBuild);
            $em->flush();
        }

        return $this->render('GameBundle:Building:academie.html.twig', array('title' => 'Recrutement Genin',
            'form' => $form->createView(), 'nb' => $nb, 'genin' => $genin));
    }
}