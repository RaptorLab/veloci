<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/03/16
 * Time: 13:30
 */

namespace Core\Configuration;


use PHPUnit_Framework_Assert as PHPUnit;
use Veloci\Core\Configuration\MongoDbConfigurationDefault;

class MongoDbConfigurationDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $database = 'DatabaseName';
        $host     = 'an host';
        $port     = 12345;


        $configuration = new MongoDbConfigurationDefault($database);

        PHPUnit::assertEquals($database, $configuration->getDatabaseName());
        PHPUnit::assertEquals('localhost', $configuration->getHost());
        PHPUnit::assertEquals(27017, $configuration->getPort());

        $configuration = new MongoDbConfigurationDefault($database, $host, $port);

        PHPUnit::assertEquals($host, $configuration->getHost());
        PHPUnit::assertEquals($port, $configuration->getPort());

    }
}
