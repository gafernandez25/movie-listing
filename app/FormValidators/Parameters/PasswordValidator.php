<?php

namespace App\FormValidators\Parameters;

use App\FormValidators\Rules\EqualToRule;
use App\FormValidators\Rules\LengthRule;
use App\FormValidators\Rules\RequiredRule;
use App\FormValidators\Rules\SpecialCharactersRule;
use App\FormValidators\Rules\UppercaseRule;

class PasswordValidator extends ParameterValidator
{
    public function __construct(
        private RequiredRule $requiredRule,
        private LengthRule $lengthRule,
        private UppercaseRule $uppercaseRule,
        private SpecialCharactersRule $specialCharactersRule,
        private EqualToRule $equalToRule
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
        $errorMessages[] = "Password is required";
        return false;
    }

    public function length(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        $length = $ruleValues;
        if ($this->lengthRule->validate($inputValue, $length)) {
            return true;
        }
        $errorMessages[] = "Password must have $length digits";
        return false;
    }

    public function uppercase(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        list($minQuantity, $maxQuantity) = explode("|", $ruleValues);
        if ($this->uppercaseRule->validate($inputValue, $minQuantity, $maxQuantity)) {
            return true;
        }
        $errorMessages[] = "Password must have between $minQuantity and $maxQuantity uppercase letters";
        return false;
    }

    public function specialCharacters(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        $characters = explode("|", $ruleValues);
        if ($this->specialCharactersRule->validate($inputValue, $characters)) {
            return true;
        }
        $errorMessages[] = "Password must have one of these characters: $ruleValues";
        return false;
    }

    public function equalTo(mixed $inputValue, ?string $ruleValues, array &$errorMessages): bool
    {
        $retypePass = $ruleValues;
        if ($this->equalToRule->validate($inputValue, $retypePass)) {
            return true;
        }
        $errorMessages[] = "Passwords are different";
        return false;
    }

}