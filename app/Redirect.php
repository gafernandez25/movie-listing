<?php

namespace App;

/**
 * Handle redirections
 */
class Redirect
{
    public function __construct(private Request $request)
    {
    }

    /**
     * Redirects to previous URL
     *
     * Saves in session input parameters and error messages to be used in view
     * @param array $errorMessages
     * @return void
     */
    public function back(array $errorMessages = []): void
    {
        $_SESSION["inputParams"] = (array)($this->request->getRequest());
        $_SESSION["errorMessages"] = $errorMessages;
        header("location: " . $_SERVER["HTTP_REFERER"]);
    }

    public function route(string $route): void
    {
        header("Location: " . $route);
    }
}