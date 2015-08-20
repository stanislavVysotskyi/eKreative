<?php

namespace eKreativeBundle\Controller;

use eKreativeBundle\Entity\User;
use eKreativeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /** generate list of users
     * @return main page, list of users
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('eKreativeBundle:User')
            ->findAll();

        return $this->render('eKreativeBundle:User:index.html.twig', array('users' => $users));
    }

    /**
     * get form for creating new user
     * @return html form
     */
    public function formAction()
    {
        $form = $this->createForm(new UserType(), new User());

        return new JsonResponse(
            ['form' => $this->renderView('eKreativeBundle:Forms:new.html.twig', array('form' => $form->createView()))], 200
        );
    }

    /**
     * save new user
     * @param $request
     * @return form with errors, if form is not valid
     */
    public function saveAction(Request $request)
    {
        $form = $this->createForm(new UserType(), new User());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return new JsonResponse(['form' => null], 201);
        } else {
            return new JsonResponse(
                ['form' => $this->renderView('eKreativeBundle:Forms:new.html.twig', array('form' => $form->createView()))], 404
            );
        }
    }

    /**
     * delete user by id
     * @param $id
     * @return status
     */
    public function deleteAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('eKreativeBundle:User')
            ->find($id);

        $messages = $this->getDoctrine()
            ->getRepository('eKreativeBundle:Message')
            ->findBy(array('userTo' => $id));

        $em = $this->getDoctrine()->getManager();

        foreach ($messages as $message) {
            $em->remove($message);
            $em->flush();
        }

        if ($user) {
            $em->remove($user);
            $em->flush();

            return new JsonResponse(['user' => $user->getEmail()], 201);
        } else {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
    }
}