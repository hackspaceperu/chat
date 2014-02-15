<?php

namespace HackspaceUni\ChatBundle\Controller;

use HackspaceUni\ChatBundle\Entity\Mensaje;
use HackspaceUni\ChatBundle\Form\MensajeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HackspaceUniChatBundle:Default:index.html.twig', array('name' => $name));
    }

    public function contactsAction()
    {
        return new Response("Contactos");
    }

    public function legalAction()
    {
        return $this->render(
            'HackspaceUniChatBundle:Default:legal.html.twig',
            array(
            )
        );

    }

    public function chatAction(Request $request)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $mensajes = $em->getRepository('HackspaceUniChatBundle:Mensaje')->findAll();

        $mensaje = new Mensaje();
        $form = $this->createForm(
            new MensajeType(),
            $mensaje,
            array(
                'method' => 'post',
                'action' => $this->generateUrl('hackspace_uni_chat_chat')
            )
        );
        $form->add('enviar','submit');

        $form->handleRequest($request);

        if($form->isValid())
        {

            $em->persist($form->getData());
            $em->flush();
        }
        return $this->render('HackspaceUniChatBundle:Default:chat.html.twig',
            array(
                'mensaje' => $mensaje,
                'mensajes' => $mensajes,
                'form' => $form->createView()
            )
        );
    }
}
