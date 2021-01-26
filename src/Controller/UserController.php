<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $session = $request->getSession();
        if ($session->has('_security.last_username')) {
            $this->addFlash('notice','you are already logged in');
            return $this->redirectToRoute('userprofile');
        }
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
    public function showProfile(Request $request){
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice','you have to login first');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('user/UserProfile.html.twig');
    }
}
