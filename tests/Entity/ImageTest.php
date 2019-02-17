<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use PHPUnit\Framework\TestCase; 

class ImageTest extends TestCase
{   
    /** @var Image */
    private $image;

    protected function setUp()
    {
        $this->image = new Image();
    }

    public function testHasUrl()
    {
        $this->image->setUrl('http://image.com');
        self::assertSame('http://image.com', $this->image->getUrl());
    }

    public function testHasAlt()
    {
        $this->image->setAlt('description de l\'image');
        self::assertEquals('description de l\'image', $this->image->getAlt());
    }
    
}