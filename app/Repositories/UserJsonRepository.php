<?php

namespace App\Repositories;

use App\Interfaces\UserDTOInterface;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Exceptions\ReadFileException;
use Exceptions\WriteFileException;

/**
 * Repository to save and query user data from json files
 */
class UserJsonRepository implements UserRepositoryInterface
{
    private string $fileName;

    public function __construct(private UserDTOInterface $userDTO)
    {
        $this->fileName = dirname(__DIR__, 2) . "/storage/json_repository/users.json";
    }

    /**
     * Creates a new user
     * @param object $userData
     * @return void
     */
    public function register(object $userData): void
    {
        try {
            if (file_exists($this->fileName)) {
                $current_data = json_decode(file_get_contents($this->fileName), true);
            } else {
                $current_data = [];
            }
        } catch (Exception) {
            throw new ReadFileException();
        }
        $current_data[] = $userData;

        try {
            file_put_contents($this->fileName, json_encode($current_data));
        } catch (Exception) {
            throw new WriteFileException();
        }
    }

    /**
     * Get list of users
     * @return array
     */
    public function users(): array
    {
        if (!file_exists($this->fileName)) {
            return [];
        }
        return json_decode(file_get_contents($this->fileName), true);
    }

    /**
     * Get user with specific username
     * @param string $username
     * @return object|null
     */
    public function getByUsername(string $username): ?object
    {
        $users = $this->users();

        $filter = array_values(
            array_filter($users, function ($user) use ($username) {
                return $user["username"] == $username;
            })
        );

        return !empty($filter) ? $this->userDTO->parseUser($filter[0]) : null;
    }
}