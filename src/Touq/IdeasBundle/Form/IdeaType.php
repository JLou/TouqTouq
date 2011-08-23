<?php

namespace Touq\IdeasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class IdeaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('category')
        ;
    }

    public function getName()
    {
        return 'touq_ideasbundle_ideatype';
    }
}
