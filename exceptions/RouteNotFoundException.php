<?php

namespace Exceptions;

/**
 * Exception to be thrown by Router when non-existing route is requested
 */
class RouteNotFoundException extends \Exception
{
    /** The error message */
    protected $message="Route not found";
}