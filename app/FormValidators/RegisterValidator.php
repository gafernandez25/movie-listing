<?php

namespace App\FormValidators;

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

        if (empty($params->username)) {
            $errorMessages[] = "Username is required";
        }
        if($this->userService->existsUsername($params->username)){
            $errorMessages[]="Username is already in use";
        }
        if (empty($params->phone)) {
            $errorMessages[] = "Phone is required";
        }
        if (empty($params->email)) {
            $errorMessages[] = "Email is required";
        }
        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $params->email)) {
            $errorMessages[] = "Email has incorrect format";
        }
        if (empty($params->password)) {
            $errorMessages[] = "Password is required";
        }
        if (empty($params->retype_password)) {
            $errorMessages[] = "Retype password is required";
        }
        if ($params->password != $params->retype_password) {
            $errorMessages[] = "Passwords are different";
        }
        if (!empty($errorMessages)) {
            $this->redirect->back($errorMessages);
            die;
        }

        return $params;
    }
}