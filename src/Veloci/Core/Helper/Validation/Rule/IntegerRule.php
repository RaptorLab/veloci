<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 12:28
 */

namespace Veloci\Core\Helper\Validation\Rule;


use Veloci\User\Exception\ValidationException;

class IntegerRule implements ValidationRule
{
    /**
     * @throws ValidationException
     */
    public function validate($value)
    {
        return is_int($value);
    }

    public function getType()
    {
        return ValidationRules::INTEGER;
    }

    public function getMessage($field)
    {
        return sprintf("The field %s must be an integer", $field);
    }
}