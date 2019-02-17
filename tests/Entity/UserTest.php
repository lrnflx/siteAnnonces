<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase; 

class UserTest extends TestCase
{   
    /** @var User */
    private $user;

    protected function setUp()
    {
        $this->user = new User();
    }

    public function testHasFirstName()
    {
        $this->user->setFirstName('pierre');
        self::assertSame('pierre', $this->user->getFirstName());
    }
    
    public function testHasEmail()
    {
        $this->user->setEmail('user@mail.com');
        self::assertSame('user@mail.com', $this->user->getEmail());
    }

    public function testHasPassword()
    {
        $this->user->setPassword('password');
        self::assertSame('password', $this->user->getPassword());
    }

    public function testHasRoleUser()
    {
        self::assertSame(['ROLE_USER'], $this->user->getRoles());
    }

    
}