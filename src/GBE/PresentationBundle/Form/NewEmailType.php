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
        $recipients = array(
            'p.a.destremau@gmail.com' => 'Pierre-Arnaud Destremau, WebMaster',
            'email@email.com' => 'Joseph de Chateauvieux, Chef de projet',
            'augustin.dst@gmail.com' => 'Augustin Destremau, Génie',
            'adavout@enfantsdumekong.com' => "Alban d'Avout, Directeur de Défi du Mékong",
            'gdaboville@enfantsdumekong.com' => "Guillaume d'Aboville, Directeur de la Communication et du Développement des Ressources"
            );

        $builder
            ->add('senderName', 'text', array('label' => 'SenderName'))
            ->add('sender', 'text', array('label' => 'Sender'))
            ->add('object', 'text', array('label' => 'Object'))
            ->add('content', 'textarea', array('label' => 'Content'))
            ->add('recipients', 'choice', array('label' => 'Recipients',
                                                "multiple" => true,
                                                "expanded" => true,
                                                "choices" => $recipients))
            ;

        // On récupère la factory (usine)
        $factory = $builder->getFormFactory();
    }

    public function getName()
    {
        return 'Email';
    }
}