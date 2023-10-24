<?php

declare(strict_types=1);

namespace Exceptions;

class InvalidPasswordException extends AuthenticationException
{
    public function __construct(string $message = 'Invalid password')
    {
        parent::__construct($message);
    }
}