<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 12:28
 */

namespace Veloci\Core\Helper\Validation\Rule;


class IntegerRule implements ValidationRule
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value):bool
    {
        return is_int($value);
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return ValidationRules::INTEGER;
    }

    /**
     * @param $field
     * @return string
     */
    public function getMessage($field):string
    {
        return sprintf('The field %s must be an integer', $field);
    }
}