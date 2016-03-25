<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 12:36
 */

namespace Veloci\Core\Helper\Validation;


use Veloci\Core\Model\EntityModel;
use Veloci\User\Exception\ValidationException;

interface ModelValidator
{
    /**
     * @param EntityModel $model
     * @throws ValidationException
     */
    public function validate(EntityModel $model);
}