<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTOs\RegisterRequestDTO;
use App\Entities\User;
use App\FormValidators\RegisterValidator;
use App\Interfaces\UserRepositoryInterface;
use App\Redirect;
use App\Services\PasswordService;
use App\Services\UserService;
use App\View;

class RegisterController
{
    public function __construct(
        private RegisterValidator $registerValidator,
        private UserRepositoryInterface $userRepository,
        private Redirect $redirect,
        private RegisterRequestDTO $registerRequestDTO,
        private PasswordService $passwordService
    ) {
    }

    public function view(): void
    {
        View::make('auth/register')->render();
    }

    public function register(): void
    {
        $request = $this->registerRequestDTO->getRequest();

        $errorMessages = $this->registerValidator->validate($request);
        if (!empty($errorMessages)) {
            $this->redirect->backWithInput(
                [
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ],
                $errorMessages
            );
        }

        $user = new User(
            username: $request->username,
            phone: $request->phone,
            email: $request->email,
            password: $this->passwordService->hashPassword($request->password),
        );

        $this->userRepository->register($user);

        $this->redirect->route('/login');
    }
}