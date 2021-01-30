<?php

namespace App\Controller\Admin;

use App\Entity\Delivery;
use App\Entity\User;
use App\Form\UserRegistryType;
use Cassandra\Type\UserType;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class DeliveryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Delivery::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $delg=$this->getDoctrine()->getRepository(User::class)->findBy(['roles'=>'delg']);
        return [
            TextField::new('Location'),
            TimeField::new('Time'),
            ChoiceField::new('User')->setChoices($delg)

        ];
    }

}
