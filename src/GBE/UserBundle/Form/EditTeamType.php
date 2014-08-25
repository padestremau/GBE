<?php
// src/GBE/UserBundle/Form/EditTeamType.php

namespace GBE\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditTeamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Name of the team'))
            ->add('leader', 'entity', array(
                                'class' => 'GBEUserBundle:User',
                                'property' => 'firstName'
                            ))
            ;

        // On récupère la factory (usine)
        $factory = $builder->getFormFactory();
    }

    public function getName()
    {
        return 'UserBundle_EditTeamType';
    }
}