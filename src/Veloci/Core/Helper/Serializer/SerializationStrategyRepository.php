<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 15:25
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Helper\Serializer\Strategy\PropertySerializationStrategy;

interface SerializationStrategyRepository
{
    /**
     * @param $type
     * @param PropertySerializationStrategy $strategy
     * @return mixed
     */
    public function register($type, PropertySerializationStrategy $strategy);

    /**
     * @param PropertySerializationStrategy $strategy
     * @return mixed
     */
    public function setFallback(PropertySerializationStrategy $strategy);

    /**
     * @param $type
     * @return PropertySerializationStrategy
     */
    public function get($type):PropertySerializationStrategy;
}