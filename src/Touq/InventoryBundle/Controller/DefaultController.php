<?php

namespace Touq\InventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('TouqInventoryBundle:Default:index.html.twig', array('name' => $name));
    }
}
