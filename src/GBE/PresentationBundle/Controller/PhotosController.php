<?php

namespace GBE\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GBE\PresentationBundle\Entity\Photo;
use GBE\PresentationBundle\Form\PhotoType;

class PhotosController extends Controller
{
    public function photosAction()
    {
    	$routes = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('GBEPresentationBundle:Routes')
                        ->findAllRoutes();

    	$photos = $this ->getDoctrine()
                        ->getManager()
                        ->getRepository('GBEPresentationBundle:Photo')
                        ->findAllPhotosByStep($routes);

        return $this->render('GBEPresentationBundle:Photos:photos.html.twig', array(
        	'photos' => $photos,
        	'routes' => $routes));
    }

    public function addAction()
    {
    	/* Current User */
        $currentUser = $this->getUser();
		$photo = new Photo();

        // On utiliser le NoteEditType
        $formNewPhoto = $this->createForm(new PhotoType(), $photo);

        // On récupère la requête
        $formNewPhoto->handleRequest($this->getRequest());

        // On vérifie que les valeurs entrées sont correctes
        if ($formNewPhoto->isValid()) {
            $photo->setLoadedBy($currentUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Photo bien ajoutée');

            // On redirige vers la page de visualisation de le document nouvellement créé
            return $this->redirect($this->generateUrl('gbe_presentation_photos'));
        }

        return $this->render('GBEPresentationBundle:Photos:addPhotos.html.twig', array(
            'formNewPhoto' => $formNewPhoto->createView()));
    }
}
