<?php

namespace Touq\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * Description of SimplePictureType
 *
 * @author JLou
 */
class SimplePictureType extends AbstractType
{
//    public function 
    public function getName()
    {
        return 'touq_gallerybundle_simplepicturetype';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('file', 'file');
    }

    public function buildViewBottomUp(FormView $view, FormInterface $form)
    {
        $view->getChild('pictures')->set('full_name', $view->getChild('file')->get('full_name') . '[]');
    }

}