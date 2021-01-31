<?php

namespace App\Controller\Admin;

use App\Entity\Delivery;
use App\Entity\DeliveryGuy;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;



use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DeliveryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Delivery::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Location'),
            DateTimeField::new('Time'),
            TextField::new('Status'),
            Field::new('DeliveryGuy')->setFormType(EntityType::class)->setFormTypeOptions(['class'=>DeliveryGuy::class])

        ];
    }

}
