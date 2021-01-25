<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Delivery;
use App\Entity\User;
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
        $session = $request->getSession();
        if ($session->has('_security.last_username')) {
            $del=new Delivery();
            $form = $this->createForm(DeliveryType::class, $del);
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$session->get('_security.last_username')]);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $del->setUser($user);
                $del->setStatus('not examined');
                $entityManager->persist($del);
                $entityManager->flush();
                return $this->redirectToRoute('foodview');
            } else {
                return $this->render('delivery/index.html.twig', [
                    "form" => $form->createView(),
                ]);
            }
        }
        return $this->redirectToRoute('app_login');
    }
}
