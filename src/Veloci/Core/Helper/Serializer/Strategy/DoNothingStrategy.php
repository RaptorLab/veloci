<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 16:17
 */

namespace Veloci\Core\Helper\Serializer\Strategy;

class DoNothingStrategy implements PropertySerializationStrategy
{

    public function serialize($data)
    {
        return $data;
    }

    public function deserialize($data)
    {
        return $data;
    }
}