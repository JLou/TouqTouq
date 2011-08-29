<?php

namespace Touq\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Touq\GalleryBundle\Entity\Picture;
use Touq\GalleryBundle\Form\PictureType;
use Symfony\Component\HttpFoundation\Session;

/**
 * @author JLou 
 */
class PictureController extends Controller
{
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $album = $em->find('TouqGalleryBundle:Album', $id);
        //Album exists
        if($album != null)
        {
            $picture = new Picture();
            $form = $this->createForm(new PictureType(), $picture);
            
            return $this->renderView('TouqGalleryBundle:Picture:new.html.twig', array(
                'form' => $form->createView() 
            ));
        }      
    }
    
    public function editAction($id = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if($id !== null)
        {
            
        }
        else
        {
            /** @var Session $session */
            $session = $this->get('session');            
            if($session->has('pictures.edit.ids'))
            {
                $form = $this->createFormBuilder();
                $form->add('pictures', 'collection');
                $ids = $session->get('pictures.edit.ids');
                if(is_array($ids))
                {
                    $repo = $em->getRepository('TouqGalleryBundle:Picture');
                    $res = $repo->findBy(array('id' => $ids));
                    foreach($res as $i => $pic)
                    {
                        $type = new PictureType($pic);
                        $form->get('pictures')->add((string)$i, $type);
                    }
                    
                    return $this->render('TouqGalleryBundle:Picture:edit.html.twig', array(
                            'edit_form' => $form->getForm()->createView(),
                            'entity'       => $res[0],
                    ));
                }
            }
        }
    }
    
    public function updateAction($id = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if($id !== null)
        {
            
        }
        else
        {
            $session = $this->get('session');
            if($session->has('pictures.edit.ids'))
            {
                $request = $this->getRequest();
                $topForm = $this->createFormBuilder();
                $topForm->add('pictures', 'collection');

                $tmp = $request->request->get('form');
                $pics = array();
                foreach($tmp['pictures'] as $i => $formData)
                {
                    $pic = $em->find('TouqGalleryBundle:Picture', $formData['id']);
                    $pics[] = $pic;
                    $form = new PictureType($pic);
                    $topForm->get('pictures')->add((string)$i, $form);
                }
                
                $form = $topForm->getForm()->bindRequest($request);
                
                if($form->isValid())
                {
                    foreach($pics as $pic)
                    {
                        $em->persist($pic);
                    }
                    $em->flush();
                }
                
                $session->remove('pictures.edit.ids');
                return $this->redirect($this->generateUrl('album_show', array('id' => $pics[0]->getAlbum()->getId())));
            }
        }
        
    }
    
    public function testAction()
    {
        $session = $this->get('session');
        $session->set('pictures.edit.ids', array(1, 2, 8));
        return $this->redirect($this->generateUrl('picture_edit_session'));
    }
}
