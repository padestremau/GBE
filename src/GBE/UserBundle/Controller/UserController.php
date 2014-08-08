<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GBE\UserBundle\Entity\User;

class UserController extends Controller
{
    public function indexUserAction()
    {
        return $this->render('GBEUserBundle:User:indexUser.html.twig');
    }

    public function teamUserAction()
    {
        /* Current User */
        $currentUser = $this->getUser();

        $team = $currentUser->getTeam();

    	$teamMembers = $this ->getDoctrine()
                        	->getManager()
                        	->getRepository('GBEUserBundle:User')
                        	->findByTeam($team);

        return $this->render('GBEUserBundle:User:teamUser.html.twig', array(
        	'teamCurrent' => $team,
        	'members' => $teamMembers

        	));
    }

    public function selectRouteAction($routeId = null)
    {
        $route = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEPresentationBundle:Routes')
                            ->find($routeId);

        $teamMembers = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEUserBundle:User')
                            ->findByRoute($route);

        return $this->render('GBEUserBundle:User:routeConfirmation.html.twig', array(
            'routeSelected' => $route,
            'members' => $teamMembers
            ));
    }

    public function confirmRouteAction($routeId = null)
    {
        /* Current User */
        $currentUser = $this->getUser();

        $route = $this ->getDoctrine()
                            ->getManager()
                            ->getRepository('GBEPresentationBundle:Routes')
                            ->find($routeId);

        $currentUser->setRoute($route);

        // Pas besoin de faire un flush avec l'EntityManager, cette méthode le fait toute seule !
        $userManager->updateUser($currentUser); 

        // On définit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Route choisie');

        // On redirige vers la page de visualisation de le document nouvellement créé
        return $this->redirect($this->generateUrl('gbe_user_homepage'));
    }

}
