<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:36
 */

namespace Veloci\Core\Helper\Serializer\Strategy;

interface PropertySerializationStrategy
{
    public function serialize($data);

    public function deserialize($data);
}