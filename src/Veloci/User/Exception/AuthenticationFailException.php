<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/03/16
 * Time: 17:33
 */

namespace Veloci\User\Exception;

use RuntimeException;

class AuthenticationFailException extends RuntimeException
{
    /**
     * @var string
     */
    private $cause;

    public function __construct(string $cause)
    {
        parent::__construct('Authorization fail');

        $this->cause = $cause;
    }

    public function getCause() {
        return $this->cause;
    }
}