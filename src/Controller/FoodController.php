<?php

namespace App\Controller;

use App\Entity\Food;
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
    public function showView(){
        return $this->render('food/FoodView.html.twig');
    }
}
