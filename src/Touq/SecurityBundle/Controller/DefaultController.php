<?php

namespace Touq\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('TouqSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
