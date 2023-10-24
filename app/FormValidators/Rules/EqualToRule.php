<?php

declare(strict_types=1);

namespace App\FormValidators\Rules;

/**
 * Validates that a value is equal to another value
 */
class EqualToRule
{
    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @param string $equalToValue
     * @return bool
     */
    public function validate(string $inputValue, string $equalToValue): bool
    {
        return $inputValue === $equalToValue;
    }
}