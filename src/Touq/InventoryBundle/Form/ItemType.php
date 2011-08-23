<?php

namespace Touq\InventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('quantity')
            ->add('location')
            ->add('type')
            ->add('picture', 'file')
        ;
    }

    public function getName()
    {
        return 'touq_inventorybundle_itemtype';
    }
}
