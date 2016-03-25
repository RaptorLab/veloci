<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 14:43
 */

namespace Core\Helper\Metadata\Domain;


use PHPUnit_Framework_TestCase;
use Veloci\Core\Helper\Metadata\Domain\BooleanDomain;

class BooleanDomainTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @dataProvider provider
     * @param $value
     *
     * @param bool $expectedResult
     */
    public function testValidation($value, bool $expectedResult)
    {
        $domain = new BooleanDomain();

        $result = $domain->validate($value);

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $result);
    }

    public function provider()
    {
        return [
            [10, false],
            [null, false],
            ['', false],

            ['false', true],
            ['true', true],
            [1, true],
            [0, true],
            [true, true],
            [false, true],
        ];
    }
}