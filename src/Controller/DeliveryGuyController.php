<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Entity\DeliveryGuy;
use App\Entity\User;
use App\Form\DeliveryGuyRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\add;

/**
 * Class DeliveryGuyController
 * @package App\Controller
 * @Route ("/delg",name="delg")
 */
class DeliveryGuyController extends AbstractController
{
    /**
     * @Route("/registry", name="registry")
     */
    public function DelgRegistry(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice', "you need to login as an admin first to have access to this route");
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $session->get('_security.last_username')]);
        $role = $user->getRoles();
        if (!$role[0]=="admin") {
            $this->addFlash('notice', "you need to be an administrator in order to have access to this content");
            return $this->redirectToRoute("userprofile");
        }else {
            $delg = new DeliveryGuy();
            $form = $this->createForm(DeliveryGuyRegistryType::class, $delg);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($delg);
                $entityManager->flush();
                return $this->redirectToRoute('delgview');
            } else {
                return $this->render('DeliveryGuy/DeliveryGuyRegistry.html.twig', [
                    "form" => $form->createView()
                ]);
            }
        }
    }

    /**
     * @Route ("/view",name="view")
     */
    public function DelgView(Request $request){
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice', "you need to login as an admin first to have access to this route");
            return $this->redirectToRoute('app_login');
        } $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $session->get('_security.last_username')]);
        $role = $user->getRoles();
        if (!$role[0]=="admin") {
            $this->addFlash('notice', "you need to be an administrator in order to have access to this content");
            return $this->redirectToRoute("userprofile");
        }
        $repository = $this->getDoctrine()->getRepository(DeliveryGuy::class);
        $delg = $repository->findAll();
        return $this->render('DeliveryGuy/DeliveryGuyView.html.twig', [
            'delgs' => $delg,
        ]);
    }
    /**
     * @Route ("/profile",name="profile")
     */
    public function profile(Request $request){
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice', "you need to login as an admin first to have access to this route");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('delivery/profile.html.twig');
    }
    /**
     * @Route ("/deliveries",name="deliveries")
     */
    public function deliverie(Request $request) {
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice', "you need to login a an delivery guy first to have access to this route");
            return $this->redirectToRoute('app_login');
        }$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $session->get('_security.last_username')]);
        $role = $user->getRoles();
        if (!$role[0]=="delg_guy") {
            $this->addFlash('notice', "you need to be a delivery guy in order to have access to this content");
            return $this->redirectToRoute("userprofile",['user'=>$user]);
        }
        $alldeliveries=$this->getDoctrine()->getRepository(Delivery::class)->findBy(['deliveryguy_id'=>$user->getId()]);
        $deliveries=[];
        foreach ($alldeliveries as $delv){
         if($delv->getStatus()=="accepted"){
             $deliveries.array_push($delv);
         }
        }
        return $this->render('DeliveryGuy/deliveries.html.twig',['deliveries'=>$deliveries]);
    }
}