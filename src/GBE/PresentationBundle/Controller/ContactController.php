<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GBE\PresentationBundle\Entity\Email;
use GBE\PresentationBundle\Form\NewEmailType;

class ContactController extends Controller
{
    public function contactAction()
    {
        $email = new Email;

        // On utiliser le NoteEditType
        $formEmail = $this->createForm(new NewEmailType(), $email);

        // On récupère la requête
        $formEmail->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEmail->isValid()) {
            $object = $formEmail->get('Email[object]')->getData();
            $sender = $formEmail->get('Email[sender]')->getData();
            $senderName = $formEmail->get('Email[senderName]')->getData();
            $content = $formEmail->get('Email[content]')->getData();

            $content = 'Ceci est un message';
            $message = \Swift_Message::newInstance()
                ->setSubject('objet ici')
                ->setFrom('test@coco.fr')
                ->setTo('p.a.destremau@gmail.com')
                ->setBody(
                    $this->renderView('GBEPresentationBundle:Contact:email.html.twig',
                        array('content' => $content)
                    )
                )
            ;
            $this->get('mailer')->send($message);

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Message bien envoyé');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_presentation_send'));
        }

        return $this->render('GBEPresentationBundle:Contact:contact.html.twig', array(
            'formEmail' => $formEmail->createView()));
    }

    public function sendAction()
    {
        return $this->render('GBEPresentationBundle:Contact:sent.html.twig');
    }


}
