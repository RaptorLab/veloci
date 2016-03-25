<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 16:42
 */

namespace Veloci\Core\Helper;


interface Validable
{
    public function validate($value):bool;

    public function formatError($value):string;

    public function getType():string;
}