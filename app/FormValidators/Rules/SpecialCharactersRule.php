<?php

declare(strict_types=1);

namespace App\FormValidators\Rules;

/**
 * Validates that a value has at least one of certain special characters
 */
class SpecialCharactersRule
{
    /**
     * special regex characters that must be escaped in regex pattern
     * @var string[]
     */
    private array $reservedCharacters = ["*", ".", "-", "?", "{", "}"];

    public function validate(string $inputValue, array $characters): bool
    {
        $pattern = "/";
        $pattern .= "[";
        foreach ($characters as $character) {
            $pattern .= ((in_array($character, $this->reservedCharacters)) ? "\\" : "") . $character;
        }
        $pattern .= "]";
        $pattern .= "/";

        $result = preg_match($pattern, $inputValue);

        if ($result === false) {
            throw new \Exception;
        }

        return boolval($result);
    }
}