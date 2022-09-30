<?php

namespace App\Services;

use App\Entities\User;
use App\Redirect;

/**
 * Authentication tools
 */
class AuthService
{

    public function __construct(
        private UserService $userService,
        private PasswordService $passwordService,
        private Redirect $redirect
    ) {
    }

    /**
     * Authenticates user with username and password
     *
     * Returns User object if authentication is successful
     *
     * Redirects back if authentication is not successful
     * @param string $username
     * @param string $password
     * @return User
     */
    public function authenticate(string $username, string $password): User
    {
        $user = $this->userService->getByUsername($username);
        if (!$user) {
            $errorMessages[] = "Username does not exist";
            $this->redirect->back($errorMessages);
            die;
        }

        if (!$this->passwordService->isPasswordValid($user->getPassword(), $password)) {
            $errorMessages[] = "Password does not match username's password";
            $this->redirect->back($errorMessages);
            die;
        }

        return $user;
    }
}