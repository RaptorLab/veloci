<?php

namespace Veloci\Core\Repository;

/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 14:52
 */
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Model\EntityModel;
use Veloci\Core\Model\RichEntityModel;

abstract class MongoDbRepository implements EntityRepository
{

    /**
     * @var MongoDbCollection
     */
    private $collectionInstance;

    /**
     * @var MongoDbManager
     */
    private $db;

    /**
     * @var ModelSerializer
     */
    private $serializer;

    /**
     * MongoDbRepository constructor.
     * @param string $collection
     */
    public function __construct(MongoDbManager $db, ModelSerializer $serializer)
    {
        $this->db         = $db;
        $this->serializer = $serializer;
    }

    /**
     * @return MongoDbCollection
     */
    protected function getCollectionInstance()
    {
        if (!$this->collectionInstance) {
            $this->collectionInstance = $this->db->getCollection($this->getCollectionName());
        }

        return $this->collectionInstance;
    }

    abstract protected function getCollectionName();

    /**
     *
     * @param mixed $id
     * @return EntityModel
     */
    public function get($id):EntityModel
    {
        $collection = $this->getCollectionInstance();

        return $collection->findById($id);
    }

    /**
     *
     * @param EntityModel $model
     * @return EntityModel
     */
    public function save(EntityModel $model):EntityModel
    {
        if ($model instanceof RichEntityModel) {
            // TODO: test serializer, it doesn't work
            $data = $this->serializer->serialize($model);

            $collection = $this->getCollectionInstance();

            var_dump($data);
            die();

            $collection->insert($data);
        }

        return $model;
    }

    /**
     *
     * @param EntityModel $model
     */
    public function delete(EntityModel $model)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return EntityModel[] A collection of entities
     */
    public function getAll():array
    {
        $collection = $this->getCollectionInstance();

        $result = $collection->find();

        return $result->toArray();
    }

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function exists(EntityModel $model)
    {
        // TODO: Implement exists() method.
    }

    /**
     * @param \Veloci\Core\Model\EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model)
    {
        // TODO: Implement accept() method.
    }
}