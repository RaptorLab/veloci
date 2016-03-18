<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 16:02
 */

namespace Veloci\Core\Repository;


use MongoDB\Collection;
use MongoDB\Database;
use Veloci\Core\Configuration\MongoDbConfiguration;

class MongoDbManagerDefault implements MongoDbManager
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /*
     * @var \MongoClient
     */
    private $databaseConnection;

    /**
     * @var \MongoCollection[]
     */
    private $collections;

    /**
     * @var string
     */
    private $databaseName;
    /**
     * @var MongoDbConfiguration
     */
    private $configuration;

    /**
     * MongoDbManagerDefault constructor.
     * @param MongoDbConfiguration $configuration
     */
    public function __construct(MongoDbConfiguration $configuration)
    {
        $this->collections   = [];
        $this->configuration = $configuration;
    }

    /**
     * @param $collectionName
     * @return MongoDbCollection
     */
    public function getCollection(string $collectionName):MongoDbCollection
    {
        if (!array_key_exists($collectionName, $this->collections)) {
            $db         = $this->getDatabaseConnection();
            $collection = $db->selectCollection($collectionName);

            $this->collections[$collectionName] = new MongoDbCollectionDefault($collection);
        }

        return $this->collections[$collectionName];
    }


    /**
     * @return Database
     */
    protected function getDatabaseConnection():Database
    {
        if (!$this->databaseConnection) {
            $client                   = new \MongoDB\Client($this->getConnectionString());
            $this->databaseConnection = $client->selectDatabase($this->configuration->getDatabaseName());
        }

        return $this->databaseConnection;
    }

    private function getConnectionString():string
    {
        return "mongodb://{$this->configuration->getHost()}:{$this->configuration->getPort()}";
    }
}