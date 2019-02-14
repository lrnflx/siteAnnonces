<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SkillFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $skill1 = new Skill();
        $skill1->setName('PHP');
        $manager->persist($skill1);

        $skill2 = new Skill();
        $skill2->setName('JavaScript');
        $manager->persist($skill2);

        $skill3 = new Skill();
        $skill3->setName('Symfony');
        $manager->persist($skill3);

        $skill4 = new Skill();
        $skill4->setName('Bootstrap');
        $manager->persist($skill4);


        $skill5 = new Skill();
        $skill5->setName('Suite Adobe');
        $manager->persist($skill5);



        $manager->flush();
    }
}
