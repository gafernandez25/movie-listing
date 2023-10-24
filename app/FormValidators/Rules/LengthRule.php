<?php

declare(strict_types=1);

namespace App\FormValidators\Rules;

/**
 * Validates length of value
 */
class LengthRule
{
    public function validate(string $inputValue, int $length): bool
    {
        $result = preg_match('/.{' . $length . '}$/', $inputValue);

        if ($result === false) {
            throw new \Exception;
        }

        return boolval($result);
    }
}