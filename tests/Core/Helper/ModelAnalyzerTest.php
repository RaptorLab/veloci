<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 01:25
 */

namespace Core\Helper;


class ModelAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldAnalyze () {
        $class = new class {
            public function getA():int {}
            public function getB():array {}
            public function getC():string {}
            public function setC(string $c) {}
            public function isD():float {}
        };
    }
}