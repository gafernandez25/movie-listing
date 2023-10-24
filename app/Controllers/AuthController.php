<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTOs\LoginRequestDTO;
use App\FormValidators\LoginValidator;
use App\Redirect;
use App\Services\AuthService;
use App\View;
use Exceptions\AuthenticationException;

class AuthController
{
    public function __construct(
        private readonly LoginValidator $loginValidator,
        private readonly AuthService $authService,
        private readonly Redirect $redirect,
        private readonly LoginRequestDTO $loginRequestDTO,
    ) {
    }

    public function view(): void
    {
        View::make('auth/login')->render();
    }

    public function login(): void
    {
        $request = $this->loginRequestDTO->getRequest();

        $errorMessages = $this->loginValidator->validate($request);
        if (!empty($errorMessages)) {
            $this->redirect->backWithInput(
                [
                    'username' => $request->username
                ],
                $errorMessages
            );
        }

        try {
            $user = $this->authService->authenticate($request->username, $request->password);
        } catch (AuthenticationException $exception) {
            $errorMessages[] = $exception->getMessage();
            $this->redirect->backWithInput(
                [
                    'username' => $request->username
                ],
                $errorMessages
            );
        }

        $_SESSION['loggedUser'] = $user->username;

        $this->redirect->route('/movies');
    }

    public function logout(): void
    {
        session_destroy();

        $this->redirect->route('/login');
    }
}