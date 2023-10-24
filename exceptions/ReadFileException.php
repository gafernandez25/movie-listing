<?php

declare(strict_types=1);

namespace Exceptions;

class ReadFileException extends \Exception
{
    protected $message = "Error when trying to read file";
}