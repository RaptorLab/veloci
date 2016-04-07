<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/04/16
 * Time: 09:49
 */

namespace Veloci\Core\Repository;

use Veloci\Core\Model\EntityModel;

abstract class AbstractRepository implements EntityRepository
{
    abstract protected function getModelClass():string;

    /**
     * @param \Veloci\Core\Model\EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model):bool
    {
        return is_a($model, $this->getModelClass(), true);
    }
}