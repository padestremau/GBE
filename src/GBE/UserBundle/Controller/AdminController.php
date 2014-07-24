<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('GBEUserBundle:Admin:index.html.twig');
    }
}
