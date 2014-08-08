<?php

namespace GBE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingsController extends Controller
{
    public function settingsUserAction()
    {
        return $this->render('GBEUserBundle:Settings:indexSettings.html.twig');
    }
}
