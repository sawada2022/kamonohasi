<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class email implements Rule
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
        if($value){
            return preg_match('/^[\w\-\.]+\@([A-Za-z0-9\-]+\.)+[A-Za-z]+$/', $value);
        } else {
            return true;
        } 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        
        return trans('validation.Email');
    }
}
