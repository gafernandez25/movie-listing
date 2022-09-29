<?php

namespace App\Repositories;

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

    public function __construct()
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

        try{
            file_put_contents($this->fileName, json_encode($current_data));
        }catch (Exception){
            throw new WriteFileException();
        }
    }
}