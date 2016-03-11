<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 11/03/16
 * Time: 15:00
 */

namespace Veloci\Core\Exception;

use Exception;

class SerializationException extends Exception
{
    public function __construct(string $message, Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}