<?php

declare(strict_types=1);

namespace App\ValueObjects;

class LoginRequest
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $captcha,
    ) {
    }
}