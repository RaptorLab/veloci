<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:37
 */

namespace Veloci\Core\Model;


use Veloci\Core\Helper\Metadata\ObjectMetadata;


interface MetadataAware
{
    /**
     * @return array
     */
    public static function setCustomMetadata(ObjectMetadata $metadata);
}