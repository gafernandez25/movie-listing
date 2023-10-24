<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Interfaces\UserRepositoryInterface;
use App\ValueObjects\RegisterRequest;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function existsUsername(string $username): bool
    {
        return !empty($this->getByUsername($username));
    }

    public function getByUsername(string $username): ?User
    {
        $user = $this->userRepository->getByUsername($username);

        if (empty($user)) {
            return null;
        }

        return new User(
            $user->username,
            $user->phone,
            $user->email,
            $user->password
        );
    }
}