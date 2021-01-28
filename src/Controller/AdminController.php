<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("panel", name="panel")
     */
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('_security.last_username')) {
            $this->addFlash('notice',"you need to login as an admin first to have access to this route");
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$session->get('_security.last_username')]);
        $role=$user->getRoles();
        if($role[0]=='admin'){
            return $this->render("admin/index.html.twig");
        }
        $this->addFlash('notice',"you need to be an administrator in order to have access to this content");
        return $this->redirectToRoute("userprofile",['user'=>$user]);
    }
}
