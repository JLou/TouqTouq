<?php

namespace Touq\IdeasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('content', 'textarea')
        ;
    }

    public function getName()
    {
        return 'touq_ideasbundle_commenttype';
    }
}
