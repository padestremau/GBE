<?php
// src/GBE/UserBundle/Form/EditAvatarType.php

namespace GBE\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditAvatarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file')
            ;

        // On récupère la factory (usine)
        $factory = $builder->getFormFactory();
    }

    public function getName()
    {
        return 'UserBundle_EditAvatarType';
    }
}