<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Interfaces\UserDTOInterface;

/**
 * Adapter class to change source format to desired format
 */
class UserJsonDTO implements UserDTOInterface
{
    /**
     * Change format of user data
     * @param array $sourceData
     * @return object
     */
    public function parseUser(array $sourceData): object
    {
        $obj = new \stdClass();

        $obj->username = $sourceData["username"];
        $obj->phone = $sourceData["phone"];
        $obj->email = $sourceData["email"];
        $obj->password = $sourceData["password"];

        return $obj;
    }
}