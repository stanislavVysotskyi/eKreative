<?php

namespace eKreativeBundle\Tests\Utility;

use eKreativeBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test for class User. How to set email
     */
    public function testCreate()
    {
        $user = new User();

        $user->setEmail('test@test.com')
            ->setFirstName('Test name')
            ->setLastName('Test last name')
        ;

        $this->assertEquals('test@test.com', $user->getEmail());
    }
}