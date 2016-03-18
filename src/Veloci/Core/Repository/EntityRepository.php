<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\Core\Repository;

use Veloci\Core\Model\EntityModel;

/**
 *
 * @author christian
 */
interface EntityRepository {

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
     * @return EntityModel[] A collection of entities
     */
    public function getAll();

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function exists(EntityModel $model):bool ;

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model):bool;

}
