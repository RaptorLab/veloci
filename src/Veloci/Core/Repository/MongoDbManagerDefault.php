<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 16:02
 */

namespace Veloci\Core\Repository;


use MongoDB\Client as MongoDBClient;
use MongoDB\Database as MongoDBDatabase;
use MongoDB\Exception\InvalidArgumentException;
use Veloci\Core\Configuration\MongoDbConfiguration;

class MongoDbManagerDefault implements MongoDbManager
{
    /*
     * @var \MongoClient
     */
    private $databaseConnection;

    /**
     * @var \MongoCollection[]
     */
    private $collections;

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
     *
     * @throws InvalidArgumentException
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
     * @return MongoDBDatabase
     *
     * @throws InvalidArgumentException
     */
    protected function getDatabaseConnection():MongoDBDatabase
    {
        if (!$this->databaseConnection) {
            $client                   = new MongoDBClient($this->getConnectionString());
            $this->databaseConnection = $client->selectDatabase($this->configuration->getDatabaseName());
        }

        return $this->databaseConnection;
    }

    private function getConnectionString():string
    {
        return "mongodb://{$this->configuration->getHost()}:{$this->configuration->getPort()}";
    }
}