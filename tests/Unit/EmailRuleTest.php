<?php

namespace Tests\Unit;

use App\FormValidators\Rules\EmailRule;
use PHPUnit\Framework\TestCase;

class EmailRuleTest extends TestCase
{
    public function testEmailFormat()
    {
        $this->assertTrue((new EmailRule())->validate("fake@mail.com"));
    }

    public function testEmailIncorrectFormat1()
    {
        $this->assertFalse((new EmailRule())->validate("fake@mail"));
    }

    public function testEmailIncorrectFormat2()
    {
        $this->assertFalse((new EmailRule())->validate("fake@mail."));
    }

    public function testEmailIncorrectFormat3()
    {
        $this->assertFalse((new EmailRule())->validate("fake"));
    }

    public function testEmailIncorrectFormat4()
    {
        $this->assertFalse((new EmailRule())->validate("@mail.com"));
    }

}