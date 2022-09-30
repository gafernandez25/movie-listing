<?php

namespace App\FormValidators\Parameters;

abstract class ParameterValidator
{
    /**
     * Available rules with their validation method names
     *
     * Those methods must be implemented by child classes for needed validations
     * @var array
     */
    protected array $rules;

    public function __construct()
    {
        $this->rules["required"] = "required";
        $this->rules["length"] = "length";
        $this->rules["plus_numeric"] = "plusNumeric";
        $this->rules["only_letters"] = "onlyLetters";
        $this->rules["email"] = "email";
        $this->rules["uppercase"] = "uppercase";
        $this->rules["special_characters"] = "specialCharacters";
        $this->rules["equal_to"] = "equalTo";
    }

    /**
     * Validates input parameter on desired rules
     *
     * Condition format: 'rule:?value'
     *
     * e.g. required
     *
     * e.g. minValue:5
     * @param array $rules [rule:?value,rule:?value,...]
     * @return bool
     */
    public function validate(
        string $inputValue,
        array $rules,
        array &$errorMessages
    ): bool {
        $result = true;
        foreach ($rules as $ruleString) {
            $ruleArray = explode(":", $ruleString);
            $ruleValues = $ruleArray[1] ?? null;
            if (!$this->{$this->rules[$ruleArray[0]]}($inputValue, $ruleValues, $errorMessages)) {
                $result = false;
            }
        }
        return $result;
    }
}