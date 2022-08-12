<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BaseController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ManagerRegistry $reg
     * @return Response
     */
    public function index(ManagerRegistry $reg): Response
    {
        $userRepo = new UserRepository($reg);
       return $this->render('index.html.twig',['users'=>$userRepo->findAll()]);
    }
}
