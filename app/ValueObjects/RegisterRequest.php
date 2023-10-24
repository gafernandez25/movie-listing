<?php

declare(strict_types=1);

namespace App\ValueObjects;

class RegisterRequest
{
    public function __construct(
        public readonly string $username,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $password,
        public readonly string $retypePassword,
    ) {
    }
}