<?php

namespace App\Controllers;

use App\FormValidators\LoginValidator;
use App\Redirect;
use App\Services\AuthService;
use App\View;
use Exception;

class AuthController
{
    public function __construct(
        private LoginValidator $loginValidator,
        private AuthService $authService,
        private Redirect $redirect
    ) {
    }

    /**
     * Load login view
     * @return void
     * @throws Exception
     */
    public function index()
    {
        return View::make("auth/login")->render();
    }

    public function login()
    {
        $validatedData = $this->loginValidator->validate();

        $user = $this->authService->authenticate($validatedData->username, $validatedData->password);

        $_SESSION["loggedUser"] = $user->getUsername();

        $this->redirect->route("/movies");
    }

    public function logout()
    {
        session_destroy();
        $this->redirect->route("/login");
    }
}