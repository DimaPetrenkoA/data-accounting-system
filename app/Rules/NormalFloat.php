<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NormalFloat implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $clean_value = preg_replace("/[^0-9.,]/","",$value);
        $normalized_value = str_replace(',','.',$clean_value);
        return is_numeric($normalized_value);
    }

    /**
     * Get the Ошибка проверки message.
     *
     * @return string
     */
    public function message()
    {
        return "Поле :attribute содержит некорректное число";
    }
}
