<?php

declare(strict_types=1);

namespace Exceptions;

class UserNotFoundException extends AuthenticationException
{
    public function __construct(string $message = 'User does not exist')
    {
        parent::__construct($message);
    }
}