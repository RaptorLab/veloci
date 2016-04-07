<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:33
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Model\EntityModel;

interface ModelSerializer
{
    /**
     * @param EntityModel $model
     * @return array
     */
    public function serialize(EntityModel $model):array;
}