<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 23:29
 */

namespace Veloci\Core\Repository\Criteria;


use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;
use Doctrine\Common\Collections\Expr\Expression;
use Doctrine\Common\Collections\Expr\ExpressionVisitor;
use Doctrine\Common\Collections\Expr\Value;

class MongoDbExpressionVisitor extends ExpressionVisitor
{

    private static $OPERATOR_MAPPING = [
        Comparison::EQ  => '$eq',
        Comparison::GT  => '$gt',
        Comparison::GTE => '$gte',
        Comparison::IN  => '$in',
        Comparison::IS  => '$eq',
        Comparison::LT  => '$lt',
        Comparison::LTE => '$lte',
        Comparison::NEQ => '$ne',
        Comparison::NIN => '$nin',
    ];

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
    }

    /**
     * Converts a comparison expression into the target query language output.
     *
     * @see ExpressionVisitor::walkComparison()
     * @param Comparison $comparison
     * @return array
     *
     * @throws \RuntimeException
     */
    public function walkComparison(Comparison $comparison)
    {
        switch ($comparison->getOperator()) {
            case Comparison::EQ:
            case Comparison::GT:
            case Comparison::GTE:
            case Comparison::IN:
            case Comparison::IS:
            case Comparison::LT:
            case Comparison::LTE:
            case Comparison::NEQ:
            case Comparison::NIN:
                $operator = self::$OPERATOR_MAPPING[$comparison->getOperator()];

                $value = $this->walkValue($comparison->getValue());

                return [$comparison->getField() => [$operator => $value]];
            default:
                throw new \RuntimeException('Unknown comparison operator: ' . $comparison->getOperator());
        }
    }

    /**
     * Converts a composite expression into the target query language output.
     *
     * @see ExpressionVisitor::walkCompositeExpression()
     * @param CompositeExpression $compositeExpr
     * @return array
     */
    public function walkCompositeExpression(CompositeExpression $compositeExpr)
    {
        $expressions = $compositeExpr->getExpressionList();

        $result = [];

        /** @var Expression $expression */
        foreach ($expressions as $expression) {
            $result += $expression->visit($this);
        }

        if ($compositeExpr->getType() === CompositeExpression::TYPE_OR) {
            return ['$or' => $result];
        }


        return $result;
    }

    /**
     * Converts a value expression into the target query language part.
     *
     * @see ExpressionVisitor::walkValue()
     * @param Value $value
     * @return mixed
     */
    public function walkValue(Value $value)
    {
        return $value->getValue();
    }
}