<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Delivery;
use App\Entity\User;
use App\Form\DeliverySubmitType;
use App\Repository\UserRepository;
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
        if ($session['data']->has('_security.last_username')) {
            $user = $this->getDoctrine()->getRepository(Admin::class)->findOneBy(['email'=>$session['data']['_security.last_username']]);
            $del = new Delivery();
            $form = $this->createForm(DeliverySubmitType::class, $del);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $del->setUser($user);
                $del->setStatus('not examinated');
                $entityManager->persist($del);
                $entityManager->flush();
                return $this->redirectToRoute('');
            } else {
                return $this->render('delivery/index.html.twig', [
                    "form" => $form->createView(),
                ]);
            }
        }
        return $this->redirectToRoute('app_login');
    }
}
