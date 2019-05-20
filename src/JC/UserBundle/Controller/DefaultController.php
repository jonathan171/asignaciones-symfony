<?php

namespace JC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JCUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
