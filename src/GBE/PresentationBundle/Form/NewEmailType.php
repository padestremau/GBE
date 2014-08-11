<?php
// src/GBE/PresentationBundle/Form/NewEmailType.php

namespace GBE\PresentationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewEmailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('senderName', 'text', array('label' => 'SenderName'))
            ->add('sender', 'text', array('label' => 'Sender'))
            ->add('object', 'text', array('label' => 'Object'))
            ->add('content', 'textarea', array('label' => 'Content'))
            ;

        // On récupère la factory (usine)
        $factory = $builder->getFormFactory();
    }

    public function getName()
    {
        return 'Email';
    }
}