<?php

namespace Touq\IdeasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('TouqIdeasBundle:Default:index.html.twig', array('name' => $name));
    }
}
