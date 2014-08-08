<?php
// src/GBE/PresentationBundle/DataFixtures/ORM/Routes.php

namespace GBE\PresentationBundle\DataFixtures\ORM;
use GBE\PresentationBundle\Entity\Routes;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class RoutesFixtures implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $names_routes = array(
        '1'=>"Lyon - Avignon",
        '2'=>"Avignon - Montpellier",
        '3'=>"Montpellier - Toulouse",
        '4'=>"Toulouse - Bordeaux",
        '5'=>"Bordeaux - La Rochelle",
        '6'=>"La Rochelle - Angers",
        '7'=>"Angers - Caen",
        '8'=>"Caen - Beauvais",
        '9'=>"Beauvais - Châlons",
        '10'=>"Châlons - Dijon",
        '11'=>"Dijon - Lyon"
        );

    $lengths = array(
        '1'=>"248 km",
        '2'=>"258 km",
        '3'=>"257 km",
        '4'=>"259 km",
        '5'=>"215 km",
        '6'=>"249 km",
        '7'=>"231 km",
        '8'=>"223 km",
        '9'=>"206 km",
        '10'=>"252 km",
        '11'=>"205 km"
        );

    $height_pos = array(
        '1'=>"439 m",
        '2'=>"1013 m",
        '3'=>"1165 m",
        '4'=>"576 m",
        '5'=>"469 m",
        '6'=>"789 m",
        '7'=>"1910 m",
        '8'=>"1242 m",
        '9'=>"831 m",
        '10'=>"1042 m",
        '11'=>"898 m"
        );

    $height_neg = array(
        '1'=>"586 m",
        '2'=>"1015 m",
        '3'=>"1060 m",
        '4'=>"708 m",
        '5'=>"479 m",
        '6'=>"754 m",
        '7'=>"1933 m",
        '8'=>"1122 m",
        '9'=>"810 m",
        '10'=>"886 m",
        '11'=>"962 m"
        );

    $start_city = array(
        '1'=>"Lyon",
        '2'=>"Avignon",
        '3'=>"Montpellier",
        '4'=>"Toulouse",
        '5'=>"Bordeaux",
        '6'=>"La Rochelle",
        '7'=>"Angers",
        '8'=>"Caen",
        '9'=>"Beauvais",
        '10'=>"Châlons",
        '11'=>"Dijon"
        );

    $end_city = array(
        '1'=>"Avignon",
        '2'=>"Montpellier",
        '3'=>"Toulouse",
        '4'=>"Bordeaux",
        '5'=>"La Rochelle",
        '6'=>"Angers",
        '7'=>"Caen",
        '8'=>"Beauvais",
        '9'=>"Châlons",
        '10'=>"Dijon",
        '11'=>"Lyon"
        );

    $start_date = array(
        '1'=> "2014-10-24 18:00:00",
        '2'=>"2014-10-25 11:30:00",
        '3'=>"2014-10-26 07:45:00",
        '4'=>"2014-10-27 01:45:00",
        '5'=>"2014-10-27 20:30:00",
        '6'=>"2014-10-28 10:45:00",
        '7'=>"2014-10-29 04:30:00",
        '8'=>"2014-10-29 21:00:00",
        '9'=>"2014-10-30 12:30:00",
        '10'=>"2014-10-31 04:15:00",
        '11'=>"2014-10-31 20:45:00"
        );

    $end_date = array(
        '1'=>"2014-10-25 11:30:00",
        '2'=>"2014-10-26 07:45:00",
        '3'=>"2014-10-27 01:45:00",
        '4'=>"2014-10-27 20:30:00",
        '5'=>"2014-10-28 10:45:00",
        '6'=>"2014-10-29 04:30:00",
        '7'=>"2014-10-29 21:00:00",
        '8'=>"2014-10-30 12:30:00",
        '9'=>"2014-10-31 04:15:00",
        '10'=>"2014-10-31 20:45:00",
        '11'=>"2014-11-01 11:00:00"
        );

    $url = array(
        '1'=>"img/route/1.png",
        '2'=>"img/route/2.png",
        '3'=>"img/route/3.png",
        '4'=>"img/route/4.png",
        '5'=>"img/route/5.png",
        '6'=>"img/route/6.png",
        '7'=>"img/route/7.png",
        '8'=>"img/route/8.png",
        '9'=>"img/route/9.png",
        '10'=>"img/route/10.png",
        '11'=>"img/route/11.png"
        );


    // Combining
    for ($i=1; $i < 12; $i++) { 
        $route = new Routes();
        $route->setName($names_routes[$i]);
        $route->setLength($lengths[$i]);
        $route->setHeightPos($height_pos[$i]);
        $route->setHeightNeg($height_neg[$i]);
        $route->setStartCity($start_city[$i]);
        $route->setEndCity($end_city[$i]);
        // $route->setStartDate($start_date[$i]);
        // $route->setEndDate($end_date[$i]);
        $route->setUrl($url[$i]);
        $route->setAlt($names_routes[$i]);
        $manager->persist($route);
    }    
    
    // Saving
    $manager->flush();
  }
}