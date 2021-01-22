<?php


namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('en');
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->encodePassword($user,'password'));
            $user->setName($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setRoles([]);
            $user->setLocation($faker->address);
            $manager->persist($user);

        }
        $manager->flush();
    }
}