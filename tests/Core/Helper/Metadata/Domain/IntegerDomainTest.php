<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 14:09
 */

namespace Core\Helper\Metadata\Domain;


use Veloci\Core\Helper\Metadata\Domain\IntegerDomain;

class IntegerDomainTest extends \PHPUnit_Framework_TestCase
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
    public function testValidation($value, $min, $max, bool $expectedResult)
    {
        $domain = new IntegerDomain($min, $max);

        $result = $domain->validate($value);

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $result);
    }

    public function provider()
    {
        return [
            [10, null, null, true],
            [-10, null, null, true],
            [null, null, null, false],
            ['not a number', null, null, false],
            ['10', null, null, false],
            [10, 5, null, true],
            [10, null, 5, false],
            [10, 5, 15, true],
            [-10, -15, -5, true],
            [10, 10, 10, true]
        ];
    }
}
