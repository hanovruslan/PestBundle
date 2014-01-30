<?php

namespace Evlz\PestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EvlzPestBundle:Default:index.html.twig', array('name' => $name));
    }
}
