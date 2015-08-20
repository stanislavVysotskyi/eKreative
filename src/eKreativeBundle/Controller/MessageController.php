<?php

namespace eKreativeBundle\Controller;

use eKreativeBundle\Entity\Message;
use eKreativeBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{
    /**
     * get form for creating new message
     * @param $id - user id
     * @return html form
     */
    public function formAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('eKreativeBundle:User')
            ->find($id);

        $message = new Message();
        $message->setUserTo($user);

        $form = $this->createForm(new MessageType(), $message);

        return new JsonResponse(
            ['form' => $this->renderView('eKreativeBundle:Forms:new.html.twig', array('form' => $form->createView()))], 200
        );
    }

    /**
     * save new message
     * @param $request
     * @return form with errors, if form is not valid
     */
    public function saveAction(Request $request)
    {
        $form = $this->createForm(new MessageType(), new Message());

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

    /** generate history for user
     * @param $id - user id
     * @return main page, list of users
     */
    public function historyAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('eKreativeBundle:User')
            ->find($id);

        $messages = $this->getDoctrine()
            ->getRepository('eKreativeBundle:Message')
            ->findBy(array('userTo' => $user->getId()));

        return $this->render('eKreativeBundle:Message:history.html.twig', array('messages' => $messages, 'user' => $user));
    }
}
