<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        return $this->render('GBEUserBundle:Admin:indexAdmin.html.twig', array(
        	'routes' => $routes,
        	'teams' => $teams,
        	'members' => $members
        	));
    }

    public function sendEmailToAllAction()
    {
        $members = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEUserBundle:User')
                            ->findAll();

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
            $object = $formEmail->get('object')->getData();
            $content = $formEmail->get('content')->getData();

            for ($i=0; $i < sizeof($members); $i++) { 
                $message = \Swift_Message::newInstance()
                    ->setContentType('text/html')
                    ->setSubject($object)
                    ->setFrom(array($sender => $senderName))
                    ->setTo($members[$i])
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
            }

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Message bien envoyé');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_presentation_send'));
        }

        return $this->render('GBEUserBundle:Admin:emailAdmin.html.twig', array(
            'members' => $members
            ));
    }

    public function sendEmailToTeamAction($routeId)
    {

    }

    public function sendEmailToOthersAction()
    {

    }

    public function deleteMemberAction($memberId)
    {
        $member = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEUserBundle:User')
                            ->find($memberId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($member);
        $em->flush();

        return $this->redirect($this->generateUrl('gbe_user_admin'));
    }

}
