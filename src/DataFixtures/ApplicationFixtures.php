<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Image;
use App\Entity\Advert;
use App\Entity\Aplication;
use Faker\Factory;


class ApplicationFixtures extends Fixture
{
 


    public function load(ObjectManager $manager)
    {
        // // $product = new Product();
        // // $manager->persist($product);
        // $this->faker = factory::create();
        // $this->addFaker($manager);
        // $manager->flush();
    }

  
}
