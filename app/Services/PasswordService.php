<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Tools to work with passwords
 */
class PasswordService
{
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function isPasswordValid(string $hashedPassword, string $plainTextPassword): bool
    {
        return password_verify($plainTextPassword, $hashedPassword);
    }
}