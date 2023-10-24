<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Entities\User;

interface UserRepositoryInterface
{
    public function register(User $user): void;

    /**
     * Get list of users
     * @return array
     */
    public function users(): array;

    /**
     * Get user with specific username
     * @param string $username
     * @return object|null
     */
    public function getByUsername(string $username): ?object;
}