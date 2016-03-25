<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 13:14
 */

namespace Veloci\Core\Helper\Metadata\Domain;


use Veloci\Core\Helper\Validable;

interface Domain extends Validable
{
    /**
     * @param string|null $init
     * @return Domain
     */
    public static function create(string $init = null):Domain;
}