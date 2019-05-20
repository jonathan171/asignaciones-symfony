<?php

namespace JC\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        return new Response('Bienvenido a mi modulo de Usuarios');
    }
    
}
