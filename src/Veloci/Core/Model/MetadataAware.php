<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:37
 */

namespace Veloci\Core\Model;


use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Helper\Metadata\PropertyMetadata;

interface MetadataAware
{
    /**
     * @return ObjectMetadata
     */
    public static function getMetadata():ObjectMetadata;
}