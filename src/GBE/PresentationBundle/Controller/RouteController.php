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

        $members = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('GBEUserBundle:User')
                        ->findAllUser();
        
        return $this->render('GBEPresentationBundle:Route:route.html.twig', array(  
            'routes' => $routes,
            'members' => $members
            ));
    }

    public function removeRouteAction()
    {
        /* Current User */
        $currentUser = $this->getUser();

        $currentUser->setRoutes();
        $currentUser->setTeam();

        $em = $this->getDoctrine()->getManager();
        $em->persist($currentUser);
        $em->flush();
        
        return $this->redirect($this->generateUrl('gbe_user_homepage'));
    }

    public function calendarAction()
    {
        return $this->render('GBEPresentationBundle:Route:calendar.html.twig');
    }
}
