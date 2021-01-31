<?php

namespace App\Controller\Admin;

use App\Entity\Delivery;
use App\Entity\DeliveryGuy;
use App\Entity\User;
use App\Form\UserRegistryType;
use Cassandra\Type\UserType;
use Doctrine\DBAL\Types\TimeImmutableType;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

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
