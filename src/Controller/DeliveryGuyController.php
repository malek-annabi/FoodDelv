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
    public function deliveries(Request $request) {
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice', "you need to login a an delivery guy first to have access to this route");
            return $this->redirectToRoute('app_login');
        }$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $session->get('_security.last_username')]);
        $role = $user->getRoles();
        if (!in_array('delg',$user->getRoles())) {
            $this->addFlash('notice', "you need to be a delivery guy in order to have access to this content");
            return $this->redirectToRoute("userprofile",['user'=>$user]);
        }
        $alldeliveries=$this->getDoctrine()->getRepository(Delivery::class)->findBy(['user'=>$user->getId()]);
        $deliveries=[];
        $i=0;
        foreach ($alldeliveries as $delv){
         if($delv->getStatus()=="accepted"){
             $deliveries[$i]=$delv;
             $i+=1;
         }
        }
        return $this->render('DeliveryGuy/deliveries.html.twig',['deliveries'=>$deliveries]);
    }
}