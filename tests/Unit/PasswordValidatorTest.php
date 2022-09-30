<?php

namespace Tests\Unit;

use App\FormValidators\Parameters\PasswordValidator;
use App\FormValidators\Rules\EqualToRule;
use App\FormValidators\Rules\LengthRule;
use App\FormValidators\Rules\RequiredRule;
use App\FormValidators\Rules\SpecialCharactersRule;
use App\FormValidators\Rules\UppercaseRule;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    public function testEqualToWithTrueValidate()
    {
        $mockEqualToRule = $this->createMock(EqualToRule::class);

        $mockEqualToRule->method("validate")->willReturn(true);

        $passwordValidator = new PasswordValidator(
            new RequiredRule(),
            new LengthRule(),
            new UppercaseRule(),
            new SpecialCharactersRule(),
            $mockEqualToRule
        );

        $messages = [];

        $this->assertTrue($passwordValidator->equalTo("fakepassword", "fakepassword", $messages));
    }

    public function testEqualToWithFalseValidate()
    {
        $mockEqualToRule = $this->createMock(EqualToRule::class);

        $mockEqualToRule->method("validate")->willReturn(false);

        $passwordValidator = new PasswordValidator(
            new RequiredRule(),
            new LengthRule(),
            new UppercaseRule(),
            new SpecialCharactersRule(),
            $mockEqualToRule
        );

        $messages = [];

        $this->assertFalse($passwordValidator->equalTo("fakepassword", "fakepassword", $messages));
    }
}