<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GBE\PresentationBundle\Entity\Email;
use GBE\PresentationBundle\Form\NewEmailType;
use GBE\PresentationBundle\Form\LogEmailType;

class ContactController extends Controller
{
    public function contactAction()
    {
        /* Current User */
        $currentUser = $this->getUser();
        $email = new Email;

        if ($currentUser) {
            // On utiliser le NoteEditType
            $formEmail = $this->createForm(new LogEmailType(), $email);
            $email->setSender($currentUser->getFirstName());
            $email->setSenderName($currentUser->getEmail());
        }
        else {
            // On utiliser le NoteEditType
            $formEmail = $this->createForm(new NewEmailType(), $email);
        }

        // On récupère la requête
        $formEmail->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEmail->isValid()) {
            if ($currentUser) {
                $senderName = $currentUser->getFirstName();
                $sender = $currentUser->getEmail();
            }
            else {
                $senderName = $formEmail->get('senderName')->getData();
                $sender = $formEmail->get('sender')->getData();
            }
            $object = $formEmail->get('object')->getData();
            $content = stripcslashes($formEmail->get('content')->getData());

            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($object)
                ->setFrom(array($sender => $senderName))
                ->setTo(array('p.a.destremau@gmail.com', 'grandeboucleetudiante@gmail.com'))
                ->setBody(
                    $this->renderView('GBEPresentationBundle:Contact:email.html.twig',
                        array('content' => $content,
                                'sender' => $sender,
                                'senderName' => $senderName,
                                'object' => $object)
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
