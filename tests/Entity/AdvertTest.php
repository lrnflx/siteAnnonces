<?php

namespace App\Tests\Entity;

use App\Entity\Advert;
use App\Entity\AdvertSkill;
use PHPUnit\Framework\TestCase; 

class AdvertTest extends TestCase
{
        /**@var Advert */
        private $advert;

        protected function setUp()
        {
            $this->advert= new Advert();
        }

        public function testRemoveSkill()
        {
            $skill = $this->createMock(AdvertSkill::class);
            
            $skill->method('getAdvert')->willReturn($this->advert);
            
            $this->advert->addSkill($skill);

            self::assertCount(1, $this->advert->getSkills());


            $skill
                ->expects(self::once())
                ->method('setAdvert')
                ->with(null);

            $this->advert->removeSkill($skill);

            self::assertCount(0, $this->advert->getSkills());
        }
}