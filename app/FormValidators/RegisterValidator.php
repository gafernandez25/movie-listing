<?php

declare(strict_types=1);

namespace App\FormValidators;

use App\FormValidators\Parameters\EmailValidator;
use App\FormValidators\Parameters\PasswordValidator;
use App\FormValidators\Parameters\PhoneValidator;
use App\FormValidators\Parameters\UsernameValidator;
use App\Redirect;
use App\Request;
use App\Services\UserService;
use App\ValueObjects\RegisterRequest;

/**
 * Validates received parameters in register action
 */
class RegisterValidator
{
    public function __construct(
        private EmailValidator $emailValidator,
        private PasswordValidator $passwordValidator,
        private PhoneValidator $phoneValidator,
        private UsernameValidator $usernameValidator,
        private UserService $userService
    ) {
    }

    /**
     * @return string[]
     */
    public function validate(RegisterRequest $request): array
    {
        $errorMessages = [];

        $rules = ["required", "only_letters"];
        $this->usernameValidator->validate($request->username, $rules, $errorMessages);

        if ($this->userService->existsUsername($request->username)) {
            $errorMessages[] = "Username is already used";
        }

        $rules = ["required", "email"];
        $this->emailValidator->validate($request->email, $rules, $errorMessages);

        $rules = ["required", "plus_numeric", "length:9"];
        $this->phoneValidator->validate($request->phone, $rules, $errorMessages);

        $rules = [
            "required",
            "length:6",
            "uppercase:1|1",
            "special_characters:*|-|.",
            "equal_to:" . $request->retypePassword
        ];
        $this->passwordValidator->validate($request->password, $rules, $errorMessages);

        return $errorMessages;
    }
}