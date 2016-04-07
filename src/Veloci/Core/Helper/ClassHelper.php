<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 12:50
 */

namespace Veloci\Core\Helper;


class ClassHelper
{
    /**
     * @param mixed $class
     * @return string
     */
    public static function getClassName($class):string
    {
        return is_string($class) ? $class : get_class($class);
    }
}