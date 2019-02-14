<?php

namespace App\Controller;


use App\Entity\Image;
use App\Entity\Skill;
use App\Entity\Advert;
use App\Form\AdvertType;
use App\Entity\AdvertSkill;
use App\Entity\Application;
use App\Form\AdvertEditType;
use App\Form\AdvertSkillType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdvertController extends AbstractController

{   /**
    * @Route("/home", name="homepage")
    */
   public function index()
   {   
       return $this->render('home.html.twig');
   }


    /**
     * @Route("/adverts", name="list_adverts")
     */
    public function list()
    {   
        // dd($this->container);
        dump($this);

        //Récupération de l'EntityManager
        $em = $this->get('doctrine')->getManager();
        $adverts = $em->getRepository(Advert::class)->findAll();
        return $this->render('advert/list.html.twig', [
            'adverts' => $adverts,
        ]);
    }

    /**
     * @Route("/advert/{id}", name="details_advert")
     */
    public function view(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository(Advert::class)->find($id);
        
        //Récupération de la liste des candidatures
        $applications = $em->getRepository(Application::class)->findBy(array('advert' => $advert)) ;

        return $this->render('advert/details.html.twig', [
            'advert' => $advert,
            'applications' => $applications, 
        

        ]);
    }

    /**
     * @Route("/admin/add", name="add_advert")
     * @IsGranted("ROLE_ADMIN_ADVERT")
     */
    public function add(Request $request)
    {  
        $advert = new Advert();
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);
        $em = $this->getDoctrine()->getManager();
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $em->persist($advert);
            $em->flush();
        
            return $this->redirectToRoute('details_advert', array('id' => $advert->getId()));
       }
        return $this->render('advert/add.html.twig', array(
            'form' => $form->createView(),

          ));
    }

    /**
     * @Route("/admin/edit/{id}", name="edit_advert")
     * @IsGranted("ROLE_ADMIN_ADVERT")
     */
    public function edit(Request $request, Advert $advert)
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // $originalSkills = new ArrayCollection();

        // // Create an ArrayCollection of the current Tag objects in the database
        // foreach ($advert->getSkills() as $skill) {
        //     $originalSkills->addSkill($skill);
        
        // }

        $form   = $this->get('form.factory')->create(AdvertEditType::class, $advert);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) 
        {   
            $em = $this->get('doctrine')->getManager();

    
        // foreach ($originalSkills as $skill) 
        // {
        //     if (false === $advert->getSkills()->contains($skill)) 
        //     {
        //         // remove the Task from the Tag
        //         $advert->removeSkill($skill);

        //         // if it was a many-to-one relationship, remove the relationship like this
        //         // $tag->setTask(null);
        
        //         $em->persist($skill);
        //      }
        // }

            $em->persist($advert);
            $em->flush();
        
        return $this->redirectToRoute('details_advert', array('id' => $advert->getId()));
        }
        return $this->render('advert/edit.html.twig', array(
            'form' => $form->createView(),
          ));
    }

     /**
     * @Route("/delete/{id}", name="delete_advert")
     */
    public function delete($id)
    {
        $em = $this->get('doctrine')->getManager();
        $advert = $em->getRepository(Advert::class)->find($id);
        $em->remove($advert);
        $em->flush();
        return $this->redirectToRoute('list_adverts');
    }

}
