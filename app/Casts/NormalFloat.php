<?php


namespace App\Casts;


use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class NormalFloat implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    public function set($model, $key, $value, $attributes)
    {
        if (! $value) {
            return null;
        }

        $clean_value = preg_replace("/[^0-9.,]/","",$value);
        $normalized_value = str_replace(',','.',$clean_value);
        return $normalized_value;
    }

}
