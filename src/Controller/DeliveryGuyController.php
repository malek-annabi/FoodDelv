<?php

namespace App\Controller;

use App\Entity\DeliveryGuy;
use App\Form\DeliveryGuyRegistryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    /**
     * @Route ("/view",name="view")
     */
    public function DelgView(){
        $repository = $this->getDoctrine()->getRepository(DeliveryGuy::class);
        $delg = $repository->findAll();

        return $this->render('DeliveryGuy/DeliveryGuyView.html.twig', [
            'delgs' => $delg,
        ]);
    }
}
