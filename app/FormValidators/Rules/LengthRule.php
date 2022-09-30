<?php

namespace App\FormValidators\Rules;

/**
 * Validates length of value
 */
class LengthRule
{
    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @param int $length
     * @return bool
     */
    public function validate(string $inputValue, int $length): bool
    {
        return preg_match('/.{' . $length . '}$/', $inputValue);
    }
}