<?php

namespace GBE\PresentationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotoRepository extends EntityRepository
{
	public function findOnePhotosByStep ($routes)
	{
		$photos = array();
		for ($i=0; $i < sizeof($routes); $i++) { 
			$arrayTemp = $this->createQueryBuilder('u')
									->where ('u.route = :route')
										->setParameter('route', $routes[$i])
									->orderBy('u.id', 'ASC')
									->setMaxResults(1)
									->getQuery()
									->getResult();

			if (sizeof($arrayTemp) != 0) {
				$photos[$i] = $arrayTemp;
			}
			else {
				$photos[$i] = '';	
			}
		}
		return $photos;
	}

	public function findAllPhotosByStep ($route)
	{
		$photos = $this->createQueryBuilder('u')
						->where ('u.route = :route')
							->setParameter('route', $route)
						->orderBy('u.id', 'ASC')
						->getQuery()
						->getResult();

		return $photos;
	}
}
