<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 24/03/16
 * Time: 21:39
 */

namespace Veloci\Core\Helper\Metadata;


use Veloci\Core\Model\EntityModel;

interface ModelValidator
{
    public function validate(EntityModel $model);
}