<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 13:15
 */

namespace Veloci\Core\Helper\Metadata\Domain;


class IntegerDomain extends AbstractDomain
{
    /**
     * @var null
     */
    private $min;

    /**
     * @var null
     */
    private $max;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $value
     * @return bool
     */
    public function validate($value):bool
    {
        return is_int($value) && ($this->min === null || $this->min <= $value) && ($this->max === null || $this->max >= $value);
    }

    public function getType():string
    {
        return sprintf('int [%d, %d]', $this->min, $this->max);
    }

    public static function create(string $init = null):Domain
    {
        if ($init !== null) {
            $init = trim($init);

            $result = preg_match('/^(\d+)?[\s]*,[\s]*(\d+)?$/', $init, $matches);

            if ($result === 1) {
                $min = self::getValue($matches, 1, null);
                $max = self::getValue($matches, 2, null);

                return new static ($min, $max);
            }
        }

        return parent::create($init);
    }

    private static function getValue(array &$array, $index, $default = null)
    {
        return array_key_exists($index, $array) && ($array[$index] !== null)
            ? $array[$index]
            : $default;
    }
}