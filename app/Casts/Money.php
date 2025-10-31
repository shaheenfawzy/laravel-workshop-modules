<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Money implements CastsAttributes
{
    public function get($model, $key, $value, array $attributes)
    {
        return number_format($value / 100, 2);
    }

    public function set($model, $key, $value, array $attributes)
    {
        return $value * 100;
    }
}