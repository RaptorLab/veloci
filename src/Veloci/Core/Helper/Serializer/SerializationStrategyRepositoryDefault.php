<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 15:47
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Helper\Serializer\Strategy\PropertySerializationStrategy;

class SerializationStrategyRepositoryDefault implements SerializationStrategyRepository
{
    /**
     * @var PropertySerializationStrategy[]
     */
    private $strategies = [];

    /**
     * @var PropertySerializationStrategy
     */
    private $fallback;

    public function register($type, PropertySerializationStrategy $strategy)
    {
        $this->strategies[$type] = $strategy;
    }

    public function setFallback(PropertySerializationStrategy $strategy)
    {
        $this->fallback = $strategy;
    }

    public function get($type):PropertySerializationStrategy
    {
        return array_key_exists($type, $this->strategies) ? $this->strategies[$type] : $this->fallback;
    }
}