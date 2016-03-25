<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 16:46
 */

namespace Veloci\Core\Helper\Metadata\Domain;

abstract class AbstractDomain implements Domain
{

    /**
     * @param string|null $init
     * @return Domain
     */
    public static function create(string $init = null):Domain
    {
        return new static();
    }

    abstract public function validate($value):bool;

    public function formatError($value):string
    {
        return sprintf('Expected %s, %s found', $this->getType(), $value);
    }

    abstract public function getType():string;
}