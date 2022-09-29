<?php

namespace App\Controllers;

use App\FormValidators\RegisterValidator;
use App\Redirect;
use App\Services\RegisterService;
use App\View;
use Exception;

/**
 * Class used for register new user
 */
class RegisterController
{
    public function __construct(
        private RegisterValidator $registerValidator,
        private RegisterService $registerService,
        private Redirect $redirect
    ) {
    }

    /**
     * Loads register view
     * @return void
     * @throws Exception
     */
    public function index()
    {
        return View::make("auth/register")->render();
    }

    public function register()
    {
        $validatedData = $this->registerValidator->validate();

        $obj = new \stdClass();
        $obj->username = $validatedData->username;
        $obj->phone = $validatedData->phone;
        $obj->email = $validatedData->email;
        $obj->password = $validatedData->password;

        $this->registerService->registerUser($obj);

        $this->redirect->route("/login");
    }
}