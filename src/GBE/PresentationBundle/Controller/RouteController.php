<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RouteController extends Controller
{
    public function routeAction()
    {
    	$routes = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('GBEPresentationBundle:Routes')
                        ->findAllRoutes();
        
        return $this->render('GBEPresentationBundle:Route:route.html.twig', 
        	array(  'routes' => $routes	));
    }

    public function calendarAction()
    {
        return $this->render('GBEPresentationBundle:Route:calendar.html.twig');
    }
}
