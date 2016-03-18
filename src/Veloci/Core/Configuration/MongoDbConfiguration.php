<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 13:40
 */

namespace Veloci\Core\Configuration;


interface MongoDbConfiguration
{

    public function getDatabaseName():string;

    public function getHost():string;

    public function getPort():int;
}