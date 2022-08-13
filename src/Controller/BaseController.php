<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
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
        return $this->render('index.html.twig', ['users' => $userRepo->findAll()]);
    }


    /**
     * @Route("/add-user",name="add_user")
     * @param ManagerRegistry $reg
     * @param Request $request
     *
     * @return Response
     */
    public function addUser(ManagerRegistry $reg, Request $request):Response
    {

        $user = new User();

        if ($request->getMethod() == "GET") {
            return $this->render('user/createUser.html.twig');
        } else {

            $user->setFirstName($request->request->get('firstName'));
            $userRepo = new UserRepository($reg);
                $userRepo->add($user);
                return $this->redirect("/");

        }

    }
}
