<?php

declare(strict_types=1);

namespace App\FormValidators\Rules;

/**
 * Validates that a value has only letters
 */
class OnlyLettersRule
{
    public function validate(string $inputValue): bool
    {
        $result = preg_match("/[^a-zA-Z]/", $inputValue);

        if ($result === false) {
            throw new \Exception;
        }

        return !$result;
    }
}