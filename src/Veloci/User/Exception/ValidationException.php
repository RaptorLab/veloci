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
    /**
     * @var array
     */
    private $errors;

    /**
     * ValidationException constructor.
     *
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct('The model is not valid');

        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors():array
    {
        return $this->errors;
    }
}