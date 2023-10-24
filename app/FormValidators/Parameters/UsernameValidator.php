<?php

declare(strict_types=1);

namespace App\FormValidators\Parameters;

use App\FormValidators\Rules\OnlyLettersRule;
use App\FormValidators\Rules\RequiredRule;

/**
 * Validates input username
 */
class UsernameValidator extends ParameterValidator
{
    protected string $fieldName = "Username";

    public function __construct(
        private RequiredRule $requiredRule,
        private OnlyLettersRule $onlyLetters
    ) {
        parent::__construct();
    }

    /**
     * Validate that parameter is not empty
     *
     * Returns true if it is valid or false if it is invalid
     *
     * Receives values if they are necessary to validate condition: e.g. minValue = 6
     *
     * Writes error message in array passed by reference
     * @param $inputValue
     * @param string|null $ruleValues
     * @param array $errorMessages
     * @return bool
     */
    public function required($inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        if ($this->requiredRule->validate($inputValue)) {
            return true;
        }
        $errorMessages[] = "Username is required";
        return false;
    }

    /**
     * Validate that parameter has only letters
     *
     * Returns true if it is valid or false if it is invalid
     *
     * Receives values if they are necessary to validate condition: e.g. minValue = 6
     *
     * Writes error message in array passed by reference
     * @param $inputValue
     * @param string|null $ruleValues
     * @param array $errorMessages
     * @return bool
     */
    public function onlyLetters($inputValue, ?string $ruleValues, array &$errorMessages)
    {
        if ($this->onlyLetters->validate($inputValue)) {
            return true;
        }
        $errorMessages[] = "Username can only have letters";
        return false;
    }
}