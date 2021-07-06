<?php


namespace App;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{

    protected $implicitRules = [
        'Accepted',
        'Filled',
        'Present',
        'Required',
        'RequiredIf',
        'RequiredUnless',
        'RequiredWith',
        'RequiredWithAll',
        'RequiredWithout',
        'RequiredWithoutAll',
        'RequiredIfLike',
        'OneOf'
    ];

    public function validateEmpty($attribute, $value)
    {
        return ! $this->validateRequired($attribute, $value);
    }

    public function validateRequiredIfLike($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'required_if_like');

        [$values, $other] = $this->prepareValuesAndOther($parameters);

        $values = array_map(function($el) {
            return Str::lower($el);
        }, $values);

        $other = Str::lower($other);

        if (in_array($other, $values)) {
            return $this->validateRequired($attribute, $value);
        }

        return true;
    }

    public function validateEmptyIfLike($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'empty_if');

        [$values, $other] = $this->prepareValuesAndOther($parameters);

        $values = array_map(function($el) {
            return Str::lower($el);
        }, $values);

        $other = Str::lower($other);

        if (in_array($other, $values)) {
            return $this->validateEmpty($attribute, $value);
        }

        return true;
    }

    public function validateEmptyWith($attribute, $value, $parameters)
    {
        if (! $this->allFailingRequired($parameters)) {
            return $this->validateEmpty($attribute, $value);
        }

        return true;
    }

    public function validateEmptyWithout($attribute, $value, $parameters)
    {
        if ($this->anyFailingRequired($parameters)) {
            return $this->validateEmpty($attribute, $value);
        }

        return true;
    }

    public function validateOneOf($attribute, $value, $parameters)
    {

        $empty_with = $this->validateEmptyWith($attribute, $value, $parameters);
        $required_without = $this->validateRequiredWithout($attribute, $value, $parameters);

        return ($empty_with && $required_without);
    }

    protected function replaceEmptyIfLike($message, $attribute, $rule, $parameters)
    {
        $parameters[0] = $this->getDisplayableAttribute($parameters[0]);
        return str_replace([':other',':value'], $parameters, $message);
    }

    protected function replaceRequiredIfLike($message, $attribute, $rule, $parameters)
    {
        $parameters[0] = $this->getDisplayableAttribute($parameters[0]);
        return str_replace([':other',':value'], $parameters, $message);
    }

    protected function replaceEmptyWith($message, $attribute, $rule, $parameters)
    {
        $parameters = array_map(function($el) {
            return $this->getDisplayableAttribute($el);
        }, $parameters);
        $parameters = implode(", ",$parameters);
        return str_replace([':values'], $parameters, $message);
    }

    protected function replaceEmptyWithout($message, $attribute, $rule, $parameters)
    {
        $parameters = array_map(function($el) {
            return $this->getDisplayableAttribute($el);
        }, $parameters);
        $parameters = implode(", ",$parameters);
        return str_replace([':values'], $parameters, $message);
    }

    protected function replaceOneOf($message, $attribute, $rule, $parameters)
    {
        $parameters = array_map(function($el) {
            return $this->getDisplayableAttribute($el);
        }, $parameters);
        $parameters = implode(", ",$parameters);
        return str_replace([':values'], $parameters, $message);
    }


}
