<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 16:00
 */

namespace Veloci\Core\Repository;

interface MongoDbManager
{
    /**
     * @param string $collectionName
     * @return MongoDbCollection
     */
    public function getCollection(string $collectionName):MongoDbCollection;
}