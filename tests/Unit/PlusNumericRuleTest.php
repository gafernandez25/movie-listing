<?php

namespace Tests\Unit;

use App\FormValidators\Rules\PlusNumericRule;
use PHPUnit\Framework\TestCase;

class PlusNumericRuleTest extends TestCase
{
    public function testCorrectPattern()
    {
        $this->assertTrue((new PlusNumericRule())->validate("+12345"));
    }

    public function testPatternNotStartingWithPlusSign()
    {
        $this->assertFalse((new PlusNumericRule())->validate("12345"));
    }

    public function testPatternWithNonNumberCharacters()
    {
        $this->assertFalse((new PlusNumericRule())->validate("+123r45"));
    }

    public function testPatterWithPlusSignNotAtTheBeggining()
    {
        $this->assertFalse((new PlusNumericRule())->validate("123+45"));
//        $this->assertTrue((new PlusNumericRule())->validate("123+45"));
        $this->assertFalse((new PlusNumericRule())->validate("12345+"));
        $this->assertFalse((new PlusNumericRule())->validate("+12345+"));
    }
}