<?php

declare(strict_types=1);

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
        $result = preg_match("/^\+(\d+)$/", $inputValue);

        if ($result === false) {
            throw new \Exception;
        }

        return boolval($result);
    }
}