<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 00:25
 */

namespace Veloci\Core\Helper\Validation\Rule;


class RequiredRule implements ValidationRule
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value):bool
    {
        return $value !== null;
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return ValidationRules::REQUIRED;
    }

    /**
     * @param $field
     * @return string
     */
    public function getMessage($field):string
    {
        return sprintf('The field %s is required', $field);
    }
}