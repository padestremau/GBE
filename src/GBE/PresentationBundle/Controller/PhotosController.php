<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhotosController extends Controller
{
    public function photosAction()
    {
        return $this->render('GBEPresentationBundle:Photos:photos.html.twig');
    }
}
