<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class UserController
 * @package App\Controller
 * @Route ("/user",name="user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/registry", name="registry")
     */
    public function UserRegistry(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserRegistryType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();
            return $this->redirectToRoute('userprofile');
        } else {
            return $this->render('/user/UserRegistry.html.twig', [
                "form" => $form->createView(),
            ]);
        }
    }
    /**
     * @Route ("/profile",name="profile")
     */
    public function showProfile(){
        return $this->render('user/UserProfile.html.twig');
    }
}
