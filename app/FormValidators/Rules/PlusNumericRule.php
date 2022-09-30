<?php

namespace App\FormValidators\Rules;

/**
 * Validates that a value is a number starting with + sign
 */
class PlusNumericRule
{
    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @return bool
     */
    public function validate(string $inputValue): bool
    {
        return preg_match("/^\+(\d+)$/", $inputValue);
    }
}