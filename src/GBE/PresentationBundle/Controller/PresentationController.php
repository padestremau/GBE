<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PresentationController extends Controller
{
    public function indexAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:index.html.twig');
    }

    public function presentationAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:presentation.html.twig');
    }

    public function bioAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:bio.html.twig');
    }
}
