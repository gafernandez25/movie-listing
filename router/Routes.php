<?php

namespace Router;

use App\Controllers\AuthController;
use App\Factories\RouterFactory;

class Routes
{
    public function set()
    {
        $router = RouterFactory::create();

        $router->get("/login", [AuthController::class, "index"])
            ->post("/login", [AuthController::class, "login"])
            ->get("/logout", [AuthController::class, "logout"]);

        $router->resolve($_SERVER["REQUEST_URI"], strtolower($_SERVER["REQUEST_METHOD"]));
    }
}