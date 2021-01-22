<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FoodFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('en');
        for ($i = 0; $i < 20; $i++) {
            $food=new Food();
            $food->setName('lasagne');
            $food->setPrice('20');
            $food->setIngedients('viande hachée tomate fromage pates');
            $food->setImage($faker->imageUrl());
            $manager->persist($food);
        }
        $manager->flush();
    }
}
