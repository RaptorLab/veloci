<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 13:40
 */

namespace Veloci\Core\Configuration;


class MongoDbConfigurationDefault implements MongoDbConfiguration
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $databaseName;

    /**
     * @var int
     */
    private $port;


    public function __construct(string $databaseName, string $host = 'localhost', int $port = 27017)
    {
        $this->databaseName = $databaseName;
        $this->host         = $host;
        $this->port         = $port;
    }

    /**
     * @return string
     */
    public function getHost():string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getDatabaseName():string
    {
        return $this->databaseName;
    }

    /**
     * @return int
     */
    public function getPort():int
    {
        return $this->port;
    }
}