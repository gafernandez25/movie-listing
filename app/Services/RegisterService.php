<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;

class RegisterService
{
    public function __construct(
        private PasswordService $passwordService,
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function registerUser(object $userData): void
    {
        $userData->password = $this->passwordService->hashPassword($userData->password);

        $this->userRepository->register($userData);
    }
}