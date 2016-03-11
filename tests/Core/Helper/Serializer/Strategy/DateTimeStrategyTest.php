<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 11/03/16
 * Time: 11:10
 */

namespace Core\Helper\Serializer\Strategy;

use Veloci\Core\Helper\Serializer\Strategy\DateTimeStrategy;

class DateTimeStrategyTest extends \PHPUnit_Framework_TestCase
{
    const DATE_TIME_FORMAT = 'H:i:s d/m/Y';

    /**
     * @test
     */
    public function shouldSerialize() {
        $currentDate = '01:02:03 04/05/2016';

        $strategy = new DateTimeStrategy(static::DATE_TIME_FORMAT);

        $dateInstance = $this->createDateTime($currentDate);

        $serializedDate = $strategy->serialize($dateInstance);

        static::assertEquals($currentDate, $serializedDate);
    }

    /**
     * @test
     */
    public function shouldDeserialize() {
        $currentDate = '01:02:03 04/05/2016';

        $strategy = new DateTimeStrategy(static::DATE_TIME_FORMAT);

        $dateInstance = $this->createDateTime($currentDate);

        $deserializedDate = $strategy->deserialize($currentDate);

        static::assertEquals($dateInstance, $deserializedDate);
    }

    /**
     * @test
     * @expectedException \Veloci\Core\Exception\SerializationException
     * @expectedExceptionMessage This strategy can't deal with this object. Expected DateTime
     */
    public function shouldNotSerialize() {
        $strategy = new DateTimeStrategy(static::DATE_TIME_FORMAT);

        $strategy->serialize(null);
    }

    /**
     * @test
     * @expectedException \Veloci\Core\Exception\SerializationException
     * @expectedExceptionMessage This strategy fails on deserialize the input data.
     */
    public function shoultNotDeserialize() {
        $strategy = new DateTimeStrategy(static::DATE_TIME_FORMAT);

        $strategy->deserialize(null);
    }

    private function createDateTime (string $date) {
        return \DateTime::createFromFormat(static::DATE_TIME_FORMAT, $date);
    }
}
