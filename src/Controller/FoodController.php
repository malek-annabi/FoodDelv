<?php

namespace App\Controller;

use App\Entity\Food;
use App\Entity\User;
use App\Form\FoodRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FoodController
 * @package App\Controller
 * @Route ("/food",name="food")
 */
class FoodController extends AbstractController
{
    /**
     * @Route("/registry", name="registry")
     */
    public function UserRegistry(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice',"you need to login as an admin first to have access to this route");
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$session->get('_security.last_username')]);
        $role=$user->getRoles();
        if(!$role[0]=='admin'){
            $this->addFlash('notice',"you need to be an administrator in order to have access to this content");
            return $this->redirectToRoute("userprofile",['user'=>$user]);
        }
        $food = new Food();
        $form = $this->createForm(FoodRegistryType::class, $food);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($food);
            $entityManager->flush();
            return $this->redirectToRoute('foodview');
        } else {
            return $this->render('/food/FoodRegistry.html.twig', [
                "form" => $form->createView(),
            ]);
        }
    }
    /**
     * @Route ("/view",name="view")
     */
    public function showView(Request $request){
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice',"you need to login as an admin first to have access to this route");
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$session->get('_security.last_username')]);
        $role=$user->getRoles();
        if(!$role[0]=='admin'){
            $this->addFlash('notice',"you need to be an administrator in order to have access to this content");
            return $this->redirectToRoute("userprofile",['user'=>$user]);
        }
        $food = $this->getDoctrine()->getRepository(Food::class)->findAll();
        return $this->render('food/FoodView.html.twig',['food'=>$food]);
    }
}
