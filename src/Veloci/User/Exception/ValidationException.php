<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 24/03/16
 * Time: 19:51
 */

namespace Veloci\User\Exception;


use Exception;

class ValidationException extends Exception
{
    public $name;
    public $type;
}