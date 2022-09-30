<?php

namespace App\Exceptions;

class ApiReadException extends \Exception
{
    protected $message = "API could not be read";
}