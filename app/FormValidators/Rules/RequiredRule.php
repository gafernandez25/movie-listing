<?php

declare(strict_types=1);

namespace App\FormValidators\Rules;

/**
 * Validates that a value is not empty
 */
class RequiredRule
{
    public function validate(string $inputValue): bool
    {
        $result = preg_match("/\S+/", $inputValue);

        if ($result === false) {
            throw new \Exception;
        }

        return boolval($result);
    }
}