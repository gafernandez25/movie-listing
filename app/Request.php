<?php

namespace App;

/**
 * Creates an object with all REQUEST params received
 */
class Request
{
    /** Request parameters */
    private object $params;

    public function __construct()
    {
        $this->params = new \stdClass();

        foreach ($_REQUEST as $key => $value) {
            $this->params->$key = $value;
        }
    }

    /**
     * Returns parameters received as an object
     *
     * Parameter names are the keys inside the object
     * @return object
     */
    public function getRequest(): object
    {
        return $this->params;
    }
}