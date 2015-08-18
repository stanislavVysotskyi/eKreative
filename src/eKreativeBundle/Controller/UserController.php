<?php

namespace eKreativeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use eKreativeBundle\Entity\User;

class UserController extends Controller
{
    public function indexAction()
    {
        $product = $this->getDoctrine()
            ->getRepository('eKreativeBundle:User')
            ->findAll();
        return $this->render('eKreativeBundle:User:index.html.twig', array('users' => $product));
    }
}
