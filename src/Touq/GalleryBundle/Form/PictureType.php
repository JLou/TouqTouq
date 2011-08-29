<?php

namespace Touq\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class PictureType extends AbstractType
{
    
    protected $picture;
    
    public function __construct($picture = null)
    {
        if(!is_null($picture))
        {
            $this->picture = $picture;
        }
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {        
        $builder
            ->add('postDate');
        if(!(!is_null($this->picture) && is_file($this->picture->getAbsolutePath())))
        {
            $builder->add('file');
        }
        else
        {
            $builder->add('id', 'hidden');
        }
        
        $builder
            ->add('description')
        ;
        
        if (!is_null($this->picture)){            
            $builder->setData($this->picture);             
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function buildViewBottomUp(FormView $view, FormInterface $form)
    {
        $view->set('url', $this->picture->getWebPath());
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Touq\GalleryBundle\Entity\Picture',
        );
    }

    public function getName()
    {
        return 'touq_gallerybundle_picturetype';
    }
}
