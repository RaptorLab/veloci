<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 00:09
 */

namespace Veloci\Core\Helper\Validation\Rule;



interface ValidationRule
{
    public function validate($value):bool;

    public function getType ():string;

    public function getMessage($field):string;
}