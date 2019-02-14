<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\ApiToken;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{

    private $faker;
    private $passwordEncoder;
    

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->faker = factory::create();
        $this->addFaker($manager);

        $manager->flush();
    }

    public function addFaker(ObjectManager $manager)
    {

        for ($i = 1; $i <=10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email);
            $user->setFirstName($this->faker->firstName);
            // On définit uniquement le role ROLE_USER qui est le role de base
            // $user->setRoles(array('ROLE_USER'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            
            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);

            $manager->persist($user);
        }

        for ($i = 1; $i <=3; $i++) {
            $user = new User();

            $user->setEmail(sprintf('admin%d@jobsite.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(array('ROLE_ADMIN'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));


            $manager->persist($user);
        }
    }
}
