<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Creates a new user
     * @param object $userData
     * @return void
     */
    public function register(object $userData): void;

}