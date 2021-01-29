<?php

namespace App\Controller\Admin;

use App\Entity\Delivery;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class DeliveryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Delivery::class;
    }
/*
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Location'),
            TimeField::new('Time'),
            ArrayField::new('user',[])

        ];
    }
*/
}
