<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RouteController extends Controller
{
    public function routeAction()
    {
        return $this->render('GBEPresentationBundle:Route:route.html.twig');
    }

    public function calendarAction()
    {
        return $this->render('GBEPresentationBundle:Route:calendar.html.twig');
    }
}
