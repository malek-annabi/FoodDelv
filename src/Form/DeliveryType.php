<?php

namespace App\Form;

use App\Entity\Delivery;
use App\Entity\DeliveryGuy;
use App\Entity\Food;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Location')
            ->add('Time',DateTimeType::class,array(
                'input' => 'datetime_immutable',
            ))
            ->add('Food',EntityType::class, [
            'class' => Food::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('f')->orderBy('f.name','DESC');
                },
            'choice_label' => 'name',
                'multiple'=>true])
            ->add('DeliveryGuy',EntityType::class, [
                'class' => DeliveryGuy::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')->orderBy('d.name','DESC');
                },
                'choice_label' => 'email',
                'multiple'=>false])
            ->add('Submit',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        /*
        $resolver->setDefaults([
            'data_class' => Delivery::class,
        ]);
        */
    }
}
