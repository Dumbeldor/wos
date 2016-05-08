<?php

namespace GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('GameBundle:Admin/Building:index.html.twig', array('title' => 'Gestion de la map'));
    }
}