<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PresentationController extends Controller
{
    public function indexAction()
    {
        return $this->render('GBEPresentationBundle:Presentation:indexPresentation.html.twig');
    }
}
