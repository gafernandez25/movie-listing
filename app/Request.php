<?php

declare(strict_types=1);

namespace App;

class Request
{
    /**
     * Parameter names are the keys of the array
     * @return array<string,mixed>
     */
    public function getRequest(): array
    {
        $params = [];

        foreach ($_REQUEST as $key => $value) {
            $params[$key] = $value;
        }

        return $params;
    }
}