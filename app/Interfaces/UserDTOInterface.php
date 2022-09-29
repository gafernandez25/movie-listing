<?php

namespace App\Interfaces;

interface UserDTOInterface
{
    public function parseUser(array $sourceData): object;
}