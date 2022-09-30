<?php

namespace App\Services;

/**
 * Tools to work with passwords
 */
class PasswordService
{
    /**
     * Creates a hash from a plain password
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Checks is received password as input is equivalent to a one hashed
     * @param string $hashedPassword
     * @param string $plainTextPassword
     * @return bool
     */
    public function isPasswordValid(string $hashedPassword, string $plainTextPassword): bool
    {
        return password_verify($plainTextPassword, $hashedPassword);
    }
}