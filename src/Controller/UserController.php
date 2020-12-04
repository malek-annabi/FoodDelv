<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserController extends AbstractController
{
    /**
     * @Route("/registry", name="user")
     */
    public function index(Request $request): Response
    {
        $user=new User();
        $form=$this->createForm(UserRegistryType::class,$user);
        $form->handleRequest($request);
        return $this->render('user/registry.html.twig', [
            'controller_name' => 'UserController',
            "form"=>$form->createView(),
        ]);
    }
}
