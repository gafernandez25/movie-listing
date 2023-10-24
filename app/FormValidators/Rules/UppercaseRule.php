<?php

declare(strict_types=1);

namespace App\FormValidators\Rules;

/**
 * Validates that a value has specific range of uppercase letters
 */
class UppercaseRule
{
    public function validate(string $inputValue, int $minQuantity, int $maxQuantity): bool
    {
        $result = preg_match("/[A-Z]{" . $minQuantity . "," . $maxQuantity . "}/", $inputValue);

        if ($result === false) {
            throw new \Exception;
        }

        return boolval($result);
    }
}