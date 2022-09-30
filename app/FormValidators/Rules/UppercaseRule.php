<?php

namespace App\FormValidators\Rules;

/**
 * Validates that a value has specific range of uppercase letters
 */
class UppercaseRule
{
    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @param int $minQuantity
     * @param int $maxQuantity
     * @return bool
     */
    public function validate(string $inputValue, int $minQuantity, int $maxQuantity): bool
    {
        return preg_match("/[A-Z]{" . $minQuantity . "," . $maxQuantity . "}/", $inputValue);
    }
}