<?php

namespace App\Controller;

use App\Entity\DeliveryGuy;
use App\Form\DeliveryGuyRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryGuyController extends AbstractController
{
    /**
     * @Route("/delg/registry", name="deliveryguyregistry")
     */
    public function index(Request $request):Response
    {
        $deliveryguy=new DeliveryGuy();
        $form=$this->createForm(DeliveryGuyRegistryType::class,$deliveryguy);
        $form->handleRequest($request);
        return $this->render('DeliveryGuy/DeliveryGuyRegistry.html.twig',['form'=>$form->createView(),
        ]
        );
    }
}
