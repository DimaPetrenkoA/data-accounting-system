<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Rules\In;

class CaseInsensitiveInRule extends In implements Rule
{
    use ValidatesAttributes;

    public function __construct(array $values)
    {
        $this->values = collect($values)->map(function ($value) {
            return Str::lower($value);
        })->toArray();
    }

    public function passes($attribute, $value)
    {
        $value = Str::lower($value);
        return $this->validateIn($attribute, $value, $this->values);
    }

    public function message()
    {
        return "Поле :attribute принимает не установленное значение: \":input\"";
    }
}
