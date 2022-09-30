<?php

namespace App\FormValidators;

use App\FormValidators\Parameters\EmailValidator;
use App\FormValidators\Parameters\PasswordValidator;
use App\FormValidators\Parameters\PhoneValidator;
use App\FormValidators\Parameters\UsernameValidator;
use App\Redirect;
use App\Request;
use App\Services\UserService;

/**
 * Validates received parameters in register action
 */
class RegisterValidator
{
    public function __construct(
        private Request $request,
        private Redirect $redirect,
        private EmailValidator $emailValidator,
        private PasswordValidator $passwordValidator,
        private PhoneValidator $phoneValidator,
        private UsernameValidator $usernameValidator,
        private UserService $userService
    ) {
    }

    /**
     * Validates request data
     *
     * Returns data object if success or redirects back with parameters if input error/s
     * @return object
     */
    public function validate(): object
    {
        $params = $this->request->getRequest();

        $errorMessages = [];

        $validation = true;

        $rules = ["required", "only_letters"];
        if (!$this->usernameValidator->validate($params->username, $rules, $errorMessages)) {
            $validation = false;
        }
        if ($this->userService->existsUsername($params->username)) {
            $errorMessages[] = "Username is already used";
            $validation = false;
        }

        $rules = ["required", "email"];
        if (!$this->emailValidator->validate($params->email, $rules, $errorMessages)) {
            $validation = false;
        }

        $rules = ["required", "plus_numeric", "length:9"];
        if (!$this->phoneValidator->validate($params->phone, $rules, $errorMessages)) {
            $validation = false;
        }

        $rules = [
            "required",
            "length:6",
            "uppercase:1|1",
            "special_characters:*|-|.",
            "equal_to:" . $params->retype_password
        ];
        if (!$this->passwordValidator->validate($params->password, $rules, $errorMessages)) {
            $validation = false;
        }

        if (!$validation) {
            $this->redirect->back($errorMessages);
            die;
        }

        return $params;
    }
}