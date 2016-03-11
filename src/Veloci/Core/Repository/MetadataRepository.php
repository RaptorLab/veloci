<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:31
 */

namespace Veloci\Core\Repository;


use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Helper\Metadata\PropertyMetadata;

interface MetadataRepository
{
    /**
     * @param string $class
     * @return ObjectMetadata
     */
    public function getMetadata($class):ObjectMetadata;
}