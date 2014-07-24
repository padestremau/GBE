<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LiveController extends Controller
{
    public function liveAction()
    {
        return $this->render('GBEPresentationBundle:Live:live.html.twig');
    }
}
