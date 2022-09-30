<?php

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

    /**
     * Returns true if it is valid or false if it is invalid
     * @param string $inputValue
     * @param array $characters Array of characters wanted in value
     * @return bool
     */
    public function validate(string $inputValue, array $characters): bool
    {
        $pattern = "/";
        $pattern .= "[";
        foreach ($characters as $character) {
            $pattern .= ((in_array($character, $this->reservedCharacters)) ? "\\" : "") . $character;
        }
        $pattern .= "]";
        $pattern .= "/";
        return preg_match($pattern, $inputValue);
    }
}