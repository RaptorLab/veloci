<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 00:25
 */

namespace Veloci\Core\Helper\Validation\Rule;


use Veloci\User\Exception\ValidationException;

class RequiredRule implements ValidationRule
{
    /**
     * @throws ValidationException
     */
    public function validate($value)
    {
        return !is_null($value);
    }

    public function getType()
    {
        return ValidationRules::REQUIRED;
    }

    public function getMessage($field)
    {
        return sprintf('The field %s is required', $field);
    }
}