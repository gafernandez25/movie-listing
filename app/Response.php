<?php

declare(strict_types=1);

namespace App;

class Response
{
    public function json(array $data): void
    {
        echo json_encode($data);
    }
}