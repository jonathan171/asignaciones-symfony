<?php

namespace JC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JC\UserBundle\Entity\User;
use JC\UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;


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
    public function addAction(){

      $user = new User();
      $form = $this->createCreateForm($user);

        return $this->render('JCUserBundle:User:add.html.twig',array('form'=>$form->createView()));

    }
        private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
                'action' => $this->generateUrl('jc_user_create'),
                'method' => 'POST'
            ));
        
        return $form;
    }
       public function createAction(Request $request)
    {   
        $user = new User();
        $form = $this->createCreateForm($user);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $password = $form->get('password')->getData();
            
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);
            
            $user->setPassword($encoded);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $successMessage= $this->get('translator')->trans('The user has been created.');
            $this->addFlash('mensaje', $successMessage);
            
            return $this->redirectToRoute('jc_user_index');
        }
        
        return $this->render('JCUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }
    public function viewAction($id){

    	$repository=$this->getDoctrine()->getRepository('JCUserBundle:User');

    	$user= $repository->find($id);
    	return new Response(' Usuario: '. $user->getUsername().' con email: '. $user->getEmail());
    }
    
}
