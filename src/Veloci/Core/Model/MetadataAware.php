<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:37
 */

namespace Veloci\Core\Model;


interface MetadataAware
{
    public static function getMetadata():array;
}