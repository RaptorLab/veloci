<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\Core\Repository;

use Closure;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Helper\Resultset\Resultset;
use Veloci\Core\Model\EntityModel;

/**
 * Description of InMemoryRepository
 *
 * @author christian
 */
abstract class InMemoryRepository extends AbstractRepository
{

    /**
     *
     * @var ArrayCollection<EntityModel>
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new ArrayCollection();
    }

    public function get($id)
    {
        return $this->repository->get($id);
    }

    /**
     *
     * @param EntityModel $model
     */
    public function delete(EntityModel $model)
    {
        if ($this->accept($model)) {
            $this->repository->remove($model->getId());
        }
    }

    /**
     *
     * @param Criteria $criteria
     * @return Resultset
     */
    public function getAll(Criteria $criteria = null):Resultset
    {
        return $this->repository->toArray();
    }

    /**
     *
     * @param EntityModel $model
     *
     * @throws \RuntimeException
     */
    public function save(EntityModel $model)
    {
        if ($this->accept($model)) {
            $this->repository->set($model->getId(), $model);
        } else {
            throw new \RuntimeException ('Invalid model');
        }
    }

    public function exists(EntityModel $model):bool
    {
        return $this->repository->containsKey($model->getId());
    }

    /**
     * @param Closure $closure
     * @return \Doctrine\Common\Collections\Collection
     */
    protected function getBy(Closure $closure):Collection
    {
        return $this->repository->filter($closure);
    }
}
