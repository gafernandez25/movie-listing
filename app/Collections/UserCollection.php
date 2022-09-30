<?php

namespace App\Collections;

use App\Entities\User;
use Exception;
use JetBrains\PhpStorm\Internal\TentativeType;
use Traversable;

class UserCollection implements \IteratorAggregate
{
    /** List of users  */
    private array $users;

    public function __construct(array $users)
    {
        $this->users = array_map(function ($user) {
            return new User(
                $user->username,
                $user->phone,
                $user->email,
                $user->password
            );
        }, $users);
    }

    /**
     * Iterator for collection
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->users);
    }
}