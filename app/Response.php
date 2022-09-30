<?php

namespace App;

class Response
{
    public function json(array $data): void
    {
        echo json_encode($data);
    }
}