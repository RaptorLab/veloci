<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:31
 */

namespace Veloci\Core\Repository;


interface MetadataRepository
{
    public function getMetadata($class):array;
}