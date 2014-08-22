<?php
// src/GBE/UserBundle/DataFixtures/ORM/TeamFixtures.php

namespace GBE\UserBundle\DataFixtures\ORM;
use GBE\UserBundle\Entity\Team;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class TeamFixtures implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $names_team = array(
        '1'=>'Team 1',
        '2'=>'Team 2',
        '3'=>'Team 3',
        '4'=>'Team 4',
        '5'=>'Team 5',
        '6'=>'Team 6',
        '7'=>'Team 7',
        '8'=>'Team 8',
        '9'=>'Team 9',
        '10'=>'Team 10',
        '11'=>'Team 11'
        );

    // Combining
    for ($i=1; $i < 12; $i++) { 
        $team = new Team();
        $team->setName($names_team[$i]);
        $team->setTeamNumber($i);
        $manager->persist($team);
    }    
    
    // Saving
    $manager->flush();
  }
}