<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('GBEUserBundle:User:index.html.twig');
    }

    public function teamAction()
    {
        return $this->render('GBEUserBundle:User:team.html.twig');
    }
}
