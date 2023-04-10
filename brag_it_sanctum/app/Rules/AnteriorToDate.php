<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnteriorToDate implements Rule
{
    public function passes($attribute, $value)
    {
        // Convert the given value to a DateTime object
        $date = new \DateTime($value);

        // Check if the year of the date is anterior to 2010
        return $date->format('Y') < 2010;
    }

    public function message()
    {
        return 'The :attribute must be a date anterior to 2010.';
    }
}
