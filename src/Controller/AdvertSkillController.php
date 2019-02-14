<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdvertSkillController extends AbstractController
{
    /**
     * @Route("/advert/skill", name="advert_skill")
     */
    public function index()
    {
        return $this->render('advert_skill/index.html.twig', [
            'controller_name' => 'AdvertSkillController',
        ]);
    }
}
