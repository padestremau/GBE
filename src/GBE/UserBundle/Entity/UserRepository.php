<?php

namespace GBE\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
	public function findByTeam ($team)
	{
		return $this->createQueryBuilder('u')
					->where ('u.team = :team')
						->setParameter('team', $team)
					->orderBy('u.lastName', 'ASC')
					->getQuery()
					->getResult();
	}

	public function findWithRouteOrder ($routes)
	{
		$members = array();
		for ($i=0; $i < sizeof($routes); $i++) { 
			$arrayTemp = $this->createQueryBuilder('u')
									->where ('u.routes = :routes')
										->setParameter('routes', $routes[$i])
									->orderBy('u.lastName', 'ASC')
									->getQuery()
									->getResult();

			if (sizeof($arrayTemp) != 0) {
				$members[$i] = $arrayTemp;
			}
			else {
				$members[$i] = '';	
			}
		}
		return $members;
	}

	public function findByRoute ($route)
	{
		return $this->createQueryBuilder('u')
					->where ('u.routes = :routes')
						->setParameter('routes', $route)
					->orderBy('u.lastName', 'ASC')
					->getQuery()
					->getResult();
	}

	public function findWithoutTeam ()
	{
		return $this->createQueryBuilder('u')
					->where ('u.routes is null')
					->orderBy('u.lastName', 'ASC')
					->getQuery()
					->getResult();
	}


	public function findAllUser() {
		return $members = $this->createQueryBuilder('u')
								->orderBy('u.team', 'ASC')
								->getQuery()
								->getResult();
	}

	
}
