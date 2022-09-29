<?php

namespace Exceptions;

class WriteFileException extends \Exception
{
    protected $message = "Error when trying to write file";
}