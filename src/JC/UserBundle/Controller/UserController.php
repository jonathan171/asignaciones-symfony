<?php

namespace JC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{ 
    public function indexAction()
    {
       $em =$this->getDoctrine()->getManager();

       $users= $em->getRepository('JCUserBundle:User')->findAll();
      /* $res = 'Lista de usuarios : <br/>';

       foreach ($users as $user) {
     
        $res .= 'Usuario: ' .$user->getUsername(). ' - Email: '.$user->getEmail(). '<br />';
       }
       return new Response($res); */

       return $this->render('JCUserBundle:User:index.html.twig', array('users'=>$users));
    }

    public function viewAction($id){

    	$repository=$this->getDoctrine()->getRepository('JCUserBundle:User');

    	$user= $repository->find($id);
    	return new Response(' Usuario: '. $user->getUsername().' con email: '. $user->getEmail());
    }
    
}
