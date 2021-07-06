<?php


namespace App\Casts;


use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class LocalizedDateTime implements CastsAttributes
{
    protected $format;

    public function __construct($format = null)
    {
        $this->format = $format;
    }

    public function get($model, $key, $value, $attributes)
    {
        if (! $value) {
            return null;
        }

        return Carbon::parse($value)->tz(config('app.timezone'))->format($this->format);
    }

    public function set($model, $key, $value, $attributes)
    {
        return Carbon::parse($value)->format("Y-m-d H:i:s");
    }
}
