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
        return $this->render('GBEPresentationBundle:Media:media.html.twig');
    }
}
