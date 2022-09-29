<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Creates a new user
     * @param object $userData
     * @return void
     */
    public function register(object $userData): void;

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