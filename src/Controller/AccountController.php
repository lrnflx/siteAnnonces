<?php

namespace App\Controller;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AccountController extends BaseController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(LoggerInterface $logger)
    {
        // dd($this->getUser());

        $logger->debug('Checking account page for' .$this->getUser()->getEmail());

        return $this->render('account/index.html.twig');
    }

    /**
     * @Route("/api/account", name="api_account")
     * @IsGranted("ROLE_USER")
     */
    public function accountApi()
    {
        $user = $this->getUser();

        return $this->json($user);


        // $em = $this->getDoctrine()->getManager();
        // $users = $em->getRepository(User::class)->findAll();
        // // dd(json_encode($users));

        // $encoders = [ new JsonEncoder()];
    
        // $normalizer = new ObjectNormalizer();
        // $normalizer->setCircularReferenceLimit(2);
        // // Add Circular reference handler
        // $normalizer->setCircularReferenceHandler(function ($object) {
        //     return $object->getId();
        // });
        // $normalizers = array($normalizer);
        // $serializer = new Serializer($normalizers, $encoders);
        // // $jsonContent contains {"name":"foo","age":99,"sportsperson":false,"createdAt":null}
        // $jsonContent = $this->get('serializer')->serialize($users, 'json');
        // // echo $jsonContent; // or return it in a Response

        // return new JsonResponse($jsonContent);
    }
}
