<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Request;
use App\ValueObjects\LoginRequest;

class LoginRequestDTO
{
    public function __construct(private readonly Request $request)
    {
    }

    public function getRequest(): LoginRequest
    {
        $params = $this->request->getRequest();

        return new LoginRequest(
            (string)$params['username'],
            (string)$params['password'],
        );
    }
}