<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * User data
 */
class User
{
    public function __construct(
        public readonly string $username,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $password
    ) {
    }

    /**
     * @return array{
     *      username: string,
     *      phone: string,
     *      email: string,
     *      password: string
     * }
     */
    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}