<?php

namespace GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin:index.html.twig', array('title' => 'Panel administration',
                                                                    'username' => $this->getUser()->getUsername()));
    }
}
