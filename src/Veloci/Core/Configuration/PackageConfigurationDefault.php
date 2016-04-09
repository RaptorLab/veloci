<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 08/04/16
 * Time: 15:04
 */

namespace Veloci\Core\Configuration;


use MongoDB\Database;

class PackageConfigurationDefault implements PackageConfiguration
{
    /**
     * @var DatabaseConfiguration
     */
    private $database;

    /**
     * @return mixed
     */
    public function getDatabase():DatabaseConfiguration
    {
        return $this->database;
    }

    /**
     * @param mixed $database
     */
    public function setDatabase(DatabaseConfiguration $database)
    {
        $this->database = $database;
    }

}