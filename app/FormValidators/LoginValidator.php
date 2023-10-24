<?php

declare(strict_types=1);

namespace App\FormValidators;

use App\FormValidators\Parameters\PasswordValidator;
use App\FormValidators\Parameters\UsernameValidator;
use App\ValueObjects\LoginRequest;

class LoginValidator
{
    public function __construct(
        private readonly UsernameValidator $usernameValidator,
        private readonly PasswordValidator $passwordValidator,
    ) {
    }

    /**
     * @return string[]
     */
    public function validate(LoginRequest $request): array
    {
        $errorMessages = [];

        $rules = ['required', 'only_letters'];
        $this->usernameValidator->validate($request->username, $rules, $errorMessages);

        $rules = [
            'required',
            'length:6',
            'uppercase:1|1',
            'special_characters:*|-|.',
        ];
        $this->passwordValidator->validate($request->password, $rules, $errorMessages);

        return $errorMessages;
    }
}