<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GBE\PresentationBundle\Entity\Email;
use GBE\PresentationBundle\Form\LogEmailType;


class AdminController extends Controller
{
    public function adminAction()
    {
    	$routes = $this ->getDoctrine()
                        	->getManager()
                        	->getRepository('GBEPresentationBundle:Routes')
                        	->findAll();

        $teams = $this ->getDoctrine()
                        	->getManager()
                        	->getRepository('GBEUserBundle:Team')
                        	->findAll();

        $members = $this ->getDoctrine()
        					->getManager()
                        	->getRepository('GBEUserBundle:User')
                        	->findWithRouteOrder($routes);

        $otherMembers = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEUserBundle:User')
                            ->findWithoutTeam();

        return $this->render('GBEUserBundle:Admin:indexAdmin.html.twig', array(
        	'routes' => $routes,
        	'teams' => $teams,
        	'members' => $members,
            'otherMembers' => $otherMembers
        	));
    }

    public function sendEmailAction($toWho)
    {
        if ($toWho == 'all') {
            $members = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('GBEUserBundle:User')
                                ->findAllUser();
        }
        elseif ($toWho == 'others') {
            $members = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('GBEUserBundle:User')
                                ->findWithoutTeam();
        }
        elseif (is_numeric($toWho)) {
            $members = $this ->getDoctrine()
                                ->getManager()
                                ->getRepository('GBEUserBundle:User')
                                ->findByRoute($toWho);
        }
        else {
            $members = array();
        }

        /* Current User */
        $currentUser = $this->getUser();
        $email = new Email;

        // On utiliser le NoteEditType
        $formEmail = $this->createForm(new LogEmailType(), $email);
        $email->setSender($currentUser->getFirstName());
        $email->setSenderName($currentUser->getEmail());

        // On récupère la requête
        $formEmail->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEmail->isValid()) {
            $senderName = 'Administration du website';
            $sender = 'contact@grande-boucle-etudiante.fr';
            $object = '[GBE Administration] '.$formEmail->get('object')->getData();
            $content = stripcslashes($formEmail->get('content')->getData());

            for ($i=0; $i < sizeof($members); $i++) { 
                $message = \Swift_Message::newInstance()
                    ->setContentType('text/html')
                    ->setSubject($object)
                    ->setFrom(array($sender => $senderName))
                    ->setTo($members[$i]->getEmail())
                    ->setBody(
                        $this->renderView('GBEUserBundle:Admin:emailAdmin.html.twig',
                            array('content' => $content,
                                    'sender' => $sender,
                                    'senderName' => $senderName,
                                    'object' => $object,
                                    'member' => $members[$i])
                        )
                    )
                ;
                $this->get('mailer')->send($message);
            }

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Message bien envoyé');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_user_admin_email_sent'));
        }

        return $this->render('GBEUserBundle:Admin:emailToAllAdmin.html.twig', array(
            'formEmail' => $formEmail->createView(),
            'members' => $members,
            'toWho' => $toWho
            ));
    }

    public function sentAction()
    {
        return $this->render('GBEUserBundle:Admin:sentAdmin.html.twig');
    }

    public function deleteMemberAction($memberId)
    {
        $member = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEUserBundle:User')
                            ->find($memberId);

        if (!$member) {
            throw $this->createNotFoundException('No guest found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($member);
        $em->flush();

        return $this->redirect($this->generateUrl('gbe_user_admin'));
    }

    public function seeAllEmailsAction()
    {
        $members = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEUserBundle:User')
                            ->findAll();

        $newsletterEmails = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEPresentationBundle:NewsletterEmail')
                            ->findAll();

        return $this->render('GBEUserBundle:Admin:seeAllEmails.html.twig', array(
            'members' => $members,
            'newsletterEmails' => $newsletterEmails
            ));
    }
    
    public function deletePhotoAction($routesId)
    {
        $routeChosen = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('GBEPresentationBundle:Routes')
                        ->find($routesId);

        $photos = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('GBEPresentationBundle:Photo')
                        ->findAllPhotosByStep($routeChosen);

        return $this->render('GBEUserBundle:Admin:deletePhotos.html.twig', array(
            'photos' => $photos,
            'routeChosen' => $routeChosen));
    }
    public function deletePhotoSingleAction($photoId)
    {
        $photo = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEPresentationBundle:Photo')
                            ->find($photoId);

        if (!$photo) {
            throw $this->createNotFoundException('No guest found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($photo);
        $em->flush();

        return $this->redirect($this->generateUrl('gbe_presentation_photos'));
    }

}
