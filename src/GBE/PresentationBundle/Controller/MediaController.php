<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function partnersAction()
    {
        return $this->render('GBEPresentationBundle:Media:partners.html.twig');
    }

    public function mediaAction()
    {
    	$routes = $this ->getDoctrine()
                        	->getManager()
                        	->getRepository('GBEPresentationBundle:Routes')
                        	->findAll();

        $teams = $this ->getDoctrine()
                        	->getManager()
                        	->getRepository('GBEUserBundle:Team')
                        	->findAll();

        $membersByRoute = $this ->getDoctrine()
        					->getManager()
                        	->getRepository('GBEUserBundle:User')
                        	->findWithRouteOrder($routes);

    	$members = $this ->getDoctrine()
                        	->getManager()
                        	->getRepository('GBEUserBundle:User')
                        	->findAll();

        return $this->render('GBEPresentationBundle:Media:media.html.twig', array(
        	'members' => $members,
        	'routes' => $routes,
        	'teams' => $teams,
        	'membersByRoute' => $membersByRoute
        	));
    }
}
