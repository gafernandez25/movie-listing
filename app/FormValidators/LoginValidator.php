<?php

namespace App\FormValidators;

use App\FormValidators\Parameters\PasswordValidator;
use App\FormValidators\Parameters\UsernameValidator;
use App\Redirect;
use App\Request;
use App\Services\PasswordService;
use App\Services\UserService;

class LoginValidator
{
    public function __construct(
        private Request $request,
        private Redirect $redirect,
        private UsernameValidator $usernameValidator,
        private PasswordValidator $passwordValidator,
        private UserService $userService,
        private PasswordService $passwordService
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

        $rules = [
            "required",
            "length:6",
            "uppercase:1|1",
            "special_characters:*|-|.",
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