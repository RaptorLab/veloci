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
use Veloci\Core\Helper\Serializer\ModelHydrator;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\Criteria\MongoDbExpressionVisitor;


abstract class MongoDbRepository extends AbstractRepository
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
     * @var ModelHydrator
     */
    private $hydrator;

    /**
     * MongoDbRepository constructor.
     * @param MongoDbManager $db
     * @param ModelSerializer $serializer
     * @param ModelHydrator $hydrator
     */
    public function __construct(MongoDbManager $db, ModelSerializer $serializer, ModelHydrator $hydrator)
    {
        $this->db         = $db;
        $this->serializer = $serializer;
        $this->hydrator   = $hydrator;
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
     * @return EntityModel | null
     */
    public function get($id)
    {
        $collection = $this->getCollectionInstance();

        return $collection->findById($id);
    }

    /**
     *
     * @param EntityModel $model
     * @return EntityModel
     *
     * @throws \RuntimeException
     */
    public function save(EntityModel $model):EntityModel
    {
        if ($model instanceof EntityModel) {
            // TODO: test serializer, it doesn't work
            $data = $this->serializer->serialize($model);

            $collection = $this->getCollectionInstance();

            $result = $collection->insert($data);

            $model = $this->hydrator->hydrate($this->getModelClass(), $result, true);
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
     * @param Criteria $criteria
     * @param bool $hydrate
     * @return Resultset A collection of entities
     */
    public function getAll(Criteria $criteria = null, $hydrate = true):Resultset
    {
        $collection = $this->getCollectionInstance();

        $query = ($criteria !== null)
            ? $criteria->getWhereExpression()->visit(new MongoDbExpressionVisitor())
            : [];

        $hydrator = ($hydrate === true) ? $this->hydrator : null;

        $users = new MongodbResultset($collection->find($query), $hydrator);

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
}