<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/04/16
 * Time: 12:08
 */

namespace Veloci\Core\Configuration;


interface DatabaseConfiguration
{
    public function getType():string;
}