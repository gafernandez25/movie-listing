<?php

namespace App\Services;

use App\Entities\User;
use App\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * Informs if exists a user with specific username
     * @param string $username
     * @return bool
     */
    public function existsUsername(string $username): bool
    {
        return !empty($this->getByUsername($username));
    }

    /**
     * Returns user with specific username
     *
     * Returns false if user does not exist
     * @param string $username
     * @return User
     */
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