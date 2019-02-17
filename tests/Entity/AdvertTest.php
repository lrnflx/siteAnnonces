<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Advert;
use App\Entity\AdvertSkill;
use App\Entity\Application;
use PHPUnit\Framework\TestCase; 
use Doctrine\Common\Collections\ArrayCollection;

class AdvertTest extends TestCase
{
        /**@var Advert */
        private $advert;

        protected function setUp()
        {
            $this->advert= new Advert();
        }

        public function testConstruct()
        {
            self::assertInstanceOf(ArrayCollection::class,$this->advert->getApplication());
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

        public function testHasImage()
        {
            $image = $this->createMock(Image::class);
            $this->advert->setImage($image);
            self::assertSame($image, $this->advert->getImage());
        }

        public function testHasApplication()
        {
            $application = $this->createMock(Application::class);
            $application->method('getAdvert')->willReturn($this->advert);

            $this->advert->addApplication($application);
            self::assertCount(1,$this->advert->getApplication());

            $this->advert->removeApplication($application);
            self::assertCount(0, $this->advert->getApplication());
        }
      
}