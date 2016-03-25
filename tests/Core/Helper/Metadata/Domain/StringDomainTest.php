<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 14:18
 */

namespace Core\Helper\Metadata\Domain;


use Veloci\Core\Helper\Metadata\Domain\StringDomain;

class StringDomainTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @dataProvider provider
     * @param $value
     * @param $min
     * @param $max
     *
     * @param bool $expectedResult
     */
    public function testValidation($value, $regex, bool $expectedResult)
    {
        $domain = new StringDomain($regex);

        $result = $domain->validate($value);

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $result);
    }

    public function provider()
    {
        return [
            ['I am a string', null, true ], // a proper string
            [10, null, false], // Not a string
            ['username1234', '/^username1234$/', true], // Exact match
            ['enum1','/enum1|enum2/', true],  // enumerations
            ['username1234', '/^[a-zA-Z0-9]{4,12}$/', true], // pattern match
            ['!3r453f!##', '/^[a-zA-Z0-9]{4,12}$/', false], // pattern match
            ['longLongStringMoreThan12Characters', '/^[a-zA-Z0-9]{4,12}$/', false], // pattern match
            ['s', '/^[a-zA-Z0-9]{4,12}$/', false], // pattern match
            ['', null, true], // empty
        ];
    }
}