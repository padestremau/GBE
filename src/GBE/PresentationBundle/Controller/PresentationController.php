<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GBE\PresentationBundle\Entity\NewsletterEmail;

class PresentationController extends Controller
{
    public function indexAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:index.html.twig');
    }

    public function NewsletterAction()
    {
        $allMails = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('GBEPresentationBundle:NewsletterEmail')
                                ->findAll();

        $newsletterEmail = new NewsletterEmail;
        $email = stripslashes($_POST['newsletterEmail']);
        $newsletterEmail->setEmail($email);

        $decision = 'YES';
        for ($i=0; $i < sizeof($allMails); $i++) { 
            if ($allMails[$i]->getEmail() == $email) {
                $decision = 'NO';
            }
        }
        if ($decision == 'YES') {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletterEmail);
            $em->flush();
        }

        return $this->render('GBEPresentationBundle:Presentation:emailAdded.html.twig');
    }

    public function presentationAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:presentation.html.twig');
    }

    public function bioAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:bio.html.twig');
    }

    public function historyAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:history.html.twig');
    }
}
