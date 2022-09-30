<?php

namespace App\FormValidators\Rules;

/**
 * Validates that a value is not empty
 */
class RequiredRule
{
    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @return bool
     */
    public function validate(string $inputValue): bool
    {
        return preg_match("/\S+/", $inputValue);
    }
}