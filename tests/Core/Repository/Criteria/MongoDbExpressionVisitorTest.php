<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 00:20
 */

namespace Core\Repository\Criteria;


use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;
use Veloci\Core\Repository\Criteria\MongoDbExpressionVisitor;

class MongoDbExpressionVisitorTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleQuery()
    {
        $visitor = new MongoDbExpressionVisitor();

        $criteria = Criteria::create();

        $criteria->where(new Comparison('pippo', '=', 42));

        $result = $criteria->getWhereExpression()->visit($visitor);

        $expectedResult = ['pippo' => ['$eq' => 42]];

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $result);
    }

    public function testCompositeQuery()
    {
        $visitor = new MongoDbExpressionVisitor();

        $criteria = Criteria::create();

        $expr = Criteria::expr();

        $composite = new CompositeExpression(CompositeExpression::TYPE_OR, [
            $expr->eq('pippo', 42),
            $expr->gte('age', 18),
            new CompositeExpression(CompositeExpression::TYPE_OR, [
                $expr->in('pluto', [1, 2, 3]),
                $expr->neq('paperino', 'sfigato')
            ])
        ]);

        $criteria->where($composite);

        $result = $criteria->getWhereExpression()->visit($visitor);

        $expectedResult = [
            '$or' => [
                'pippo' => [
                    '$eq' => 42
                ],
                'age'   => [
                    '$gte' => 18
                ],
                '$or'   => [
                    'pluto'    => ['$in' => [1, 2, 3]],
                    'paperino' => ['$ne' => 'sfigato']
                ]
            ]
        ];

        \PHPUnit_Framework_Assert::assertEquals($expectedResult, $result);
    }
}
