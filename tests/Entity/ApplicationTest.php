<?php

namespace App\Tests\Entity;

use App\Entity\Application;
use PHPUnit\Framework\TestCase; 

class ApplicationTest extends TestCase
{   
    /** @var Application */
    private $application;

    protected function setUp()
    {
        $this->application = new Application();
    }

    public function testHasContent()
    {
        $this->application->setContent('le contenu de la candidature');
        self::assertEquals('le contenu de la candidature', $this->application->getContent());
    }

    public function testHasAuthor()
    {
        $this->application->setAuthor('Oscar Wilde');
        self::assertSame('Oscar Wilde', $this->application->getAuthor());
    }

    public function testHasDate()
    {   
        $date = new \Datetime();
        $this->application->setDate($date);
        self::assertEquals($date, $this->application->getDate());
    }

    
}