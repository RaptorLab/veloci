<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:33
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Model\RichEntityModel;

interface ModelSerializer
{
    public function serialize(RichEntityModel $model):array;

    public function hydrate(array $data, RichEntityModel $target):RichEntityModel;
}