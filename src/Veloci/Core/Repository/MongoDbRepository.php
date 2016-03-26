<?php

namespace Veloci\Core\Repository;

/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 14:52
 */

use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Helper\Resultset\Filter\MongoIdResultsetFilter;
use Veloci\Core\Helper\Resultset\MongodbResultset;
use Veloci\Core\Helper\Resultset\Resultset;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\Criteria\MongoDbExpressionVisitor;


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
     * @param MongoDbManager $db
     * @param ModelSerializer $serializer
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
        if ($model instanceof EntityModel) {
            // TODO: test serializer, it doesn't work
            $data = $this->serializer->serialize($model);

            $collection = $this->getCollectionInstance();

            $result = $collection->insert($data);

            $model = $this->serializer->hydrate($result, $model, true);
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
     * @return Resultset A collection of entities
     */
    public function getAll(Criteria $criteria = null):Resultset
    {
        $collection = $this->getCollectionInstance();

        $query = ($criteria !== null)
            ? $criteria->getWhereExpression()->visit(new MongoDbExpressionVisitor())
            : [];

        $users = new MongodbResultset($collection->find($query));

        $users->appendFilter(new MongoIdResultsetFilter());

        return $users;
    }

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function exists(EntityModel $model):bool
    {
        $result = $this->get($model->getId());

        return $result !== null;
    }

    /**
     * @param \Veloci\Core\Model\EntityModel $model
     * @return bool
     */
    abstract public function accept(EntityModel $model):bool;
}