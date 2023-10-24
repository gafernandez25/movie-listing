<?php

declare(strict_types=1);

namespace Exceptions;

class WriteFileException extends \Exception
{
    protected $message = "Error when trying to write file";
}