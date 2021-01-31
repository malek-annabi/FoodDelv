<?php

namespace App\Controller\Admin;

use App\Entity\Delivery;
use App\Entity\DeliveryGuy;
use App\Entity\Food;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(DeliveryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FoodDelv');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Deliveries',null,Delivery::class);
        yield MenuItem::linkToCrud('Food',null,Food::class);
        yield MenuItem::linkToCrud('Users',null,User::class);
        yield MenuItem::linkToCrud('Delivery Guys',null,DeliveryGuy::class);
    }
}
