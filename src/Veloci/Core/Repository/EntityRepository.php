<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\Core\Repository;

use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Helper\Resultset\Resultset;
use Veloci\Core\Model\EntityModel;

/**
 *
 * @author christian
 */
interface EntityRepository
{

    /**
     *
     * @param mixed $id
     * @return EntityModel|null
     */
    public function get($id);

    /**
     *
     * @param EntityModel $model
     */
    public function save(EntityModel $model);

    /**
     *
     * @param EntityModel $model
     */
    public function delete(EntityModel $model);

    /**
     * @param Criteria $criteria
     *
     * @return Resultset A collection of entities
     */
    public function getAll(Criteria $criteria = null):Resultset;

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function exists(EntityModel $model):bool;

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model):bool;
}
