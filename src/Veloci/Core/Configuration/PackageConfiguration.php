<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/04/16
 * Time: 12:07
 */

namespace Veloci\Core\Configuration;


interface PackageConfiguration
{
    public function getDatabase():DatabaseConfiguration;
}