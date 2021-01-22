<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Form\DeliveryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeliveryController
 * @package App\Controller
 * @Route ("/delivery",name="delivery")
 */
class DeliveryController extends AbstractController
{
    /**
     * @Route("/", name="addfood")
     */
    public function index(Request $request): Response
    {
        $del = new Delivery();
        $form = $this->createForm(DeliveryType::class, $del);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($del);
            $entityManager->flush();
            return $this->redirectToRoute('');
        } else {
            return $this->render('delivery/index.html.twig', [
                "form" => $form->createView(),
            ]);
        }
    }
}
