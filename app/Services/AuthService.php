<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Redirect;
use Exceptions\InvalidPasswordException;
use Exceptions\UserNotFoundException;

class AuthService
{
    public function __construct(
        private UserService $userService,
        private PasswordService $passwordService,
    ) {
    }

    public function authenticate(string $username, string $password): User
    {
        $user = $this->userService->getByUsername($username);

        if ($user === null) {
            throw new UserNotFoundException('Username does not exist');
        }

        if ($this->passwordService->isPasswordValid($user->password, $password) === false) {
            throw new InvalidPasswordException('Password does not match username\'s password');
        }

        return $user;
    }
}