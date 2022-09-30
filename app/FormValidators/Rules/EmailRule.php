<?php

namespace App\FormValidators\Rules;

/**
 * Validates that a value has email correct format
 */
class EmailRule
{
    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @return bool
     */
    public function validate(string $inputValue): bool
    {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $inputValue);
    }
}