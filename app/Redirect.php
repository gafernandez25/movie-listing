<?php

declare(strict_types=1);

namespace App;

class Redirect
{
    /**
     * @param array<string,mixed> $inputs
     * @param string[] $errorMessages
     */
    public function backWithInput(array $inputs, array $errorMessages = []): void
    {
        $_SESSION['inputParams'] = $inputs;
        $_SESSION['errorMessages'] = $errorMessages;
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
        die;
    }

    public function route(string $route): void
    {
        header(sprintf('Location: %s', $route));
        die;
    }
}