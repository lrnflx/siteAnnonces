<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Application;
use App\Form\ApplicationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApplicationController extends AbstractController
{
    /**
     * @Route("/application", name="application")
     */
    public function index()
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'ApplicationController',
        ]);
    }

    /**
     * @Route("/advert/{id}/apply" ,name="application_add")
     */
    public function addApplication(Request $request, Advert $advert)
    {
        $application = new Application();
        // $formApplication = $this->createForm(ApplicationType::class, $application);
        $formApplication = $this->get('form.factory')->create(ApplicationType::class, $application);
        $formApplication->handleRequest($request);



        if ($request->isMethod('POST') && $formApplication->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // $em->persist($advert);
            $application->setAdvert($advert);
            $em->persist($application);
            $em->flush();

            return $this->redirectToRoute('details_advert', [
                'id' => $advert->getId(),
                'application' => $application
                ]);
        }
      
            return $this->render('application/apply.html.twig', [
                'formApplication' => $formApplication->createView(),
            ]);
        // $application = new Application();
        // $application->setAuthor('Julien Dupont');
        // $application->setContent('Voilà ma candidature!');
        // $application->setAdvert($advert);
    }
}
