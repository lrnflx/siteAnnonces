<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Advert;
use App\Entity\Aplication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AdvertFixtures extends Fixture
{
    private $faker;

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
        for ($i = 1; $i<=30; $i++) {
            //Images
            $image = new Image();
            $image->setUrl($this->faker->imageUrl($width = 640, $height = 480));
            $image->setAlt($this->faker->sentence($nbWords = 5, $variableNbWords = true));
            

           //Annonces
            $advert = new Advert();
            $advert->setTitle($this->faker->word);
            $advert->setAuthor($this->faker->lastName);
            $advert->setContent($this->faker->sentence($nbWords = 20, $variableNbWords = true));
            $advert->setPublished($this->faker->boolean($chanceOfGettingTrue = 50));
            $advert->setImage($image);
            $manager->persist($advert);
        }
    }
}
