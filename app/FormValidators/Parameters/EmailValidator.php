<?php

namespace App\FormValidators\Parameters;

use App\FormValidators\Rules\EmailRule;
use App\FormValidators\Rules\RequiredRule;

/**
 * Validates input email
 */
class EmailValidator extends ParameterValidator
{
    public function __construct(
        private RequiredRule $requiredRule,
        private EmailRule $emailRule
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
        $errorMessages[] = "Email is required";
        return false;
    }

    public function email($inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        if ($this->emailRule->validate($inputValue)) {
            return true;
        }
        $errorMessages[] = "Email has incorrect format";
        return false;
    }
}