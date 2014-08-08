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
}
