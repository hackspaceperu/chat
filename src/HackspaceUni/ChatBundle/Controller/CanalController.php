<?php

namespace HackspaceUni\ChatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HackspaceUni\ChatBundle\Entity\Canal;
use HackspaceUni\ChatBundle\Form\CanalType;

/**
 * Canal controller.
 *
 */
class CanalController extends Controller
{

    /**
     * Lists all Canal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HackspaceUniChatBundle:Canal')->findAll();

        return $this->render('HackspaceUniChatBundle:Canal:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Canal entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Canal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('canal_show', array('id' => $entity->getId())));
        }

        return $this->render('HackspaceUniChatBundle:Canal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Canal entity.
    *
    * @param Canal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Canal $entity)
    {
        $form = $this->createForm(new CanalType(), $entity, array(
            'action' => $this->generateUrl('canal_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Canal entity.
     *
     */
    public function newAction()
    {
        $entity = new Canal();
        $form   = $this->createCreateForm($entity);

        return $this->render('HackspaceUniChatBundle:Canal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Canal entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HackspaceUniChatBundle:Canal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Canal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HackspaceUniChatBundle:Canal:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Canal entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HackspaceUniChatBundle:Canal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Canal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HackspaceUniChatBundle:Canal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Canal entity.
    *
    * @param Canal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Canal $entity)
    {
        $form = $this->createForm(new CanalType(), $entity, array(
            'action' => $this->generateUrl('canal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Canal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HackspaceUniChatBundle:Canal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Canal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('canal_edit', array('id' => $id)));
        }

        return $this->render('HackspaceUniChatBundle:Canal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Canal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HackspaceUniChatBundle:Canal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Canal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('canal'));
    }

    /**
     * Creates a form to delete a Canal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('canal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
