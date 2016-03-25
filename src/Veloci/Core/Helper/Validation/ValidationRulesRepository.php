<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 12:45
 */

namespace Veloci\Core\Helper\Validation;


use Veloci\Core\Helper\Validation\Rule\ValidationRule;

interface ValidationRulesRepository
{
    /**
     * @param $model
     * @return ValidationRule[]
     */
    public function getValidationRules($model):array;
}