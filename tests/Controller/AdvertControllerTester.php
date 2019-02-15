<?php
namespace App\Tests\Controller;

use App\Controller\AdvertController;
use Symfony\Component\Panther\PantherTestCase;

class AdvertControllerTester extends PantherTestCase
{
    private $client;    
    
    public function setUp()
    {
        $this->client = static::createPantherClient();
    }

    public function testMyPageOfAdverts()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/adverts');
        $this->assertContains('Petites annonces', $crawler->filter('h1')->text()); 
    }
}