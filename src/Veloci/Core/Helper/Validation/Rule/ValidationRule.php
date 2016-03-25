<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 00:09
 */

namespace Veloci\Core\Helper\Validation\Rule;

use Veloci\User\Exception\ValidationException;

interface ValidationRule
{
    /**
     * @throws ValidationException
     */
    public function validate($value);
}