<?php

namespace App\FormValidators\Parameters;

use App\FormValidators\Rules\LengthRule;
use App\FormValidators\Rules\PlusNumericRule;
use App\FormValidators\Rules\RequiredRule;

class PhoneValidator extends ParameterValidator
{
    public function __construct(
        private RequiredRule $requiredRule,
        private PlusNumericRule $plusNumericRule,
        private LengthRule $lengthRule
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
     * @param mixed $inputValue
     * @param string|null $ruleValues
     * @param array $errorMessages
     * @return bool
     */
    public function required(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        if ($this->requiredRule->validate($inputValue)) {
            return true;
        }
        $errorMessages[] = "Phone is required";
        return false;
    }

    public function plusNumeric(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        if ($this->plusNumericRule->validate($inputValue)) {
            return true;
        }
        $errorMessages[] = "Phone has to start with + sign followed only by numbers";
        return false;
    }

    public function length(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        $length = $ruleValues;
        if ($this->lengthRule->validate(ltrim($inputValue, "+"), $length)) {
            return true;
        }
        $errorMessages[] = "Phone must have $length digits";
        return false;
    }
}