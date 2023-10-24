<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Request;
use App\ValueObjects\RegisterRequest;

class RegisterRequestDTO
{
    public function __construct(private readonly Request $request)
    {
    }

    public function getRequest(): RegisterRequest
    {
        $params = $this->request->getRequest();

        return new RegisterRequest(
            username: (string)$params['username'],
            email: (string)$params['email'],
            phone: (string)$params['phone'],
            password: (string)$params['password'],
            retypePassword: (string)$params['retype_password']
        );
    }
}