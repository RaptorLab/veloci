<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 16:01
 */

namespace   Veloci\Core\Repository;


interface MongoDbCollection
{
    public function findById($id);

    public function find (array $query = []);

    public function insert(array $data);

    public function update(array $data, array $where);

    public function delete(array $where);
}