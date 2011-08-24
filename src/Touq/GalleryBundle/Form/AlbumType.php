<?php

namespace Touq\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('pictures', 'file', array(
                'attr' => array(
                    'multiple' => ''
                ),
                "required" => FALSE,
        ));
        ;
        $builder->getForm()->createView()->getChild('pictures')->set('full_name', $this->getName() . '[pictures][]');
    }

   /**
     * Builds the form view.
     *
     * This method gets called for each type in the hierarchy starting form the
     * top most type.
     * Type extensions can further modify the view.
     *
     * Children views have been built while this method gets called so you get
     * a chance to modify them.
     *
     * @see FormTypeExtensionInterface::buildViewBottomUp()
     *
     * @param FormView      $view The view
     * @param FormInterface $form The form
     */
    public function buildViewBottomUp(FormView $view, FormInterface $form)
    {
        $view->getChild('pictures')->set('full_name', $view->getChild('pictures')->get('full_name') . '[]');       
    }
    
    public function getName()
    {
        return 'touq_gallerybundle_albumtype';
    }
}
