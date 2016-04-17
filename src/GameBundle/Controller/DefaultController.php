<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Default:index.html.twig', array('title' => 'Vue générale du village', 'user' => $this->getUser()));
    }
}
