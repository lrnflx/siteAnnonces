<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase; 

class UserTest extends TestCase
{   
    /**@var User */
    private $user;

    protected function setUp()
    {
        $this->user = new User();
    }
    
    public function testEmail()
    {
        $this->user->setEmail('user@mail.com');
        $this->assertSame('user@mail.com', $this->user->getEmail());
    }

    public function testPassword()
    {
        $this->user->setPassword('password');
        $this->assertSame('password', $this->user->getPassword());
    }

    public function testIsUser()
    {   
        $this->user->setRoles(['ROLE_USER']);
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
    }
}