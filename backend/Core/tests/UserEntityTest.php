<?php

namespace Core\tests;

use Core\Entities\User;
use Core\Entities\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testCreateUserEntity()
    {
        $user = new User(
            1,
            "Jose Luiz",
            new Email('name@gmail.com'),
            '551899999999'
        );

        $this->assertInstanceOf(User::class, $user);
    }

    public function testCreateValidEmail()
    {
        $email = new Email('teste@gmail.com');
        $this->assertInstanceOf(Email::class, $email);
    }

    public function testCreateInvalidEmail()
    {
        $this->expectExceptionMessage('E-mail not valid!');
        $email = new Email('teste-gmail.com');
    }

    public function testSetChannels()
    {
        $user = new User(
            1,
            "Jose Luiz",
            new Email('name@gmail.com'),
            '551899999999'
        );

        $user->setChannels(['test', 'sms', 'email']);
        $this->assertEquals(3, count($user->getChannels()));
    }

    public function testGetArrayFromUser()
    {
        $user = new User(
            1,
            "Jose Luiz",
            new Email('name@gmail.com'),
            '551899999999'
        );

        $this->assertIsArray($user->toArray());
        $this->assertArrayHasKey('id', $user->toArray());
    }
}
