<?php

declare(strict_types=1);

namespace App\Interfaces;

interface UserDTOInterface
{
    public function parseUser(array $sourceData): object;
}