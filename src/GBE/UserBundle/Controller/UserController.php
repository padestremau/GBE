<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GBE\UserBundle\Entity\User;

use GBE\UserBundle\Form\EditUserType;
use GBE\UserBundle\Form\EditTeamType;
use GBE\UserBundle\Form\EditAvatarType;

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

    public function editUserAction() {

        /* Current User */
        $currentUser = $this->getUser();

        // On utiliser le NoteEditType
        $formEditUser = $this->createForm(new EditUserType(), $currentUser);

        // On récupère la requête
        $formEditUser->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEditUser->isValid()) {
            // Pas besoin de faire un flush avec l'EntityManager, cette méthode le fait toute seule !
            $userManager = $this->getDoctrine()->getManager();
            $userManager->updateUser($currentUser); 

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Informations bien modifiées');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_user_homepage'));
        }

        return $this->render('GBEUserBundle:User:editUser.html.twig', array(
            'formEditUser' => $formEditUser->createView()));
    }

    public function editTeamNameAction() {

        /* Current User */
        $currentUser = $this->getUser();

        $team = $currentUser->getTeam();

        // On utiliser le NoteEditType
        $formEditTeam = $this->createForm(new EditTeamType(), $team);

        // On récupère la requête
        $formEditTeam->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEditTeam->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Informations bien modifiées');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_user_team'));
        }

        return $this->render('GBEUserBundle:User:editTeam.html.twig', array(
            'formEditTeam' => $formEditTeam->createView()));
    }

    public function editAvatarAction()
    {
        /* Current User */
        $currentUser = $this->getUser();

        // On utiliser le NoteEditType
        $formEditAvatar = $this->createForm(new EditAvatarType(), $currentUser);

        // On récupère la requête
        $formEditAvatar->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formEditAvatar->isValid()) {
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($currentUser);
            // $em->flush();
            // Pas besoin de faire un flush avec l'EntityManager, cette méthode le fait toute seule !
            $userManager = $this->getDoctrine()->getManager();
            $userManager->updateUser($currentUser); 

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Informations bien modifiées');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_user_homepage'));
        }

        return $this->render('GBEUserBundle:User:editAvatar.html.twig', array(
            'formEditAvatar' => $formEditAvatar->createView()));
    }

}
