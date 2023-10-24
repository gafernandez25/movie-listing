<?php

declare(strict_types=1);

namespace App\Exceptions;

class ApiReadException extends \Exception
{
    protected $message = "API could not be read";
}