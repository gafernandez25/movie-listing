<?php

declare(strict_types=1);

namespace Router;

use App\Controllers\AuthController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Factories\RouterFactory;

class Routes
{
    public function set()
    {
        $router = RouterFactory::create();

        $router->get('/', [MovieController::class, 'index']);

        $router->get('/login', [AuthController::class, 'view'])
            ->post('/login', [AuthController::class, 'login'])
            ->get('/logout', [AuthController::class, 'logout'])
            ->get('/register', [RegisterController::class, 'view'])
            ->post('/register', [RegisterController::class, 'register']);

        $router->get('/movies', [MovieController::class, 'view'])
            ->post('/movies/update', [MovieController::class, 'update'])
            ->get('/movies/search', [MovieController::class, 'search']);

        $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
    }
}