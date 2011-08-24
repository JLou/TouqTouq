<?php

namespace Touq\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Touq\GalleryBundle\Entity\Album;
use Touq\GalleryBundle\Entity\Picture;
use Touq\GalleryBundle\Form\AlbumType;

/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
    /**
     * Lists all Album entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TouqGalleryBundle:Album')->findAll();

        return $this->render('TouqGalleryBundle:Album:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Album entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TouqGalleryBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TouqGalleryBundle:Album:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Album entity.
     *
     */
    public function newAction()
    {
        $entity = new Album();
        $form   = $this->createForm(new AlbumType(), $entity);

        return $this->render('TouqGalleryBundle:Album:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Album entity.
     *
     */
    public function createAction()
    {
        $entity  = new Album();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlbumType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $files = ($entity->getPictures());
            
            $pictures = array();
            $entity->setPictures($pictures);
            
            /** @var UploadedFile $files */
            foreach($files as $file)
            {
                $picture = new Picture();
                $picture->setFile($file);
                $picture->upload();
                $picture->setAlbum($entity);
                $picture->setPostDate(new \DateTime());
                $em->persist($picture);
                
                $pictures[] = $picture;
            }
            
            $entity->setPictures($pictures);
            $em->persist($entity);
            $em->flush();
            return new \Symfony\Component\HttpFoundation\Response('test');
//            return $this->redirect($this->generateUrl('album_show', array('id' => $entity->getId())));
            
        }
        
        
        return $this->render('TouqGalleryBundle:Album:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Album entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TouqGalleryBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $editForm = $this->createForm(new AlbumType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TouqGalleryBundle:Album:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Album entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TouqGalleryBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $editForm   = $this->createForm(new AlbumType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('album_edit', array('id' => $id)));
        }

        return $this->render('TouqGalleryBundle:Album:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Album entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TouqGalleryBundle:Album')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Album entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('album'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
