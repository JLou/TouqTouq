<?php

namespace Touq\InventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Touq\InventoryBundle\Entity\ItemCategory;
use Touq\InventoryBundle\Form\ItemCategoryType;

/**
 * ItemCategory controller.
 *
 */
class ItemCategoryController extends Controller
{
    /**
     * Lists all ItemCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TouqInventoryBundle:ItemCategory')->findAll();

        return $this->render('TouqInventoryBundle:ItemCategory:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a ItemCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TouqInventoryBundle:ItemCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TouqInventoryBundle:ItemCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new ItemCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new ItemCategory();
        $form   = $this->createForm(new ItemCategoryType(), $entity);

        return $this->render('TouqInventoryBundle:ItemCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new ItemCategory entity.
     *
     */
    public function createAction()
    {
        $entity  = new ItemCategory();
        $request = $this->getRequest();
        $form    = $this->createForm(new ItemCategoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categories_show', array('id' => $entity->getId())));
            
        }

        return $this->render('TouqInventoryBundle:ItemCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ItemCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TouqInventoryBundle:ItemCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemCategory entity.');
        }

        $editForm = $this->createForm(new ItemCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TouqInventoryBundle:ItemCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ItemCategory entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TouqInventoryBundle:ItemCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemCategory entity.');
        }

        $editForm   = $this->createForm(new ItemCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categories_edit', array('id' => $id)));
        }

        return $this->render('TouqInventoryBundle:ItemCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ItemCategory entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TouqInventoryBundle:ItemCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ItemCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categories'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
