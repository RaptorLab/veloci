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
use Doctrine\Common\Collections\Expr\ExpressionVisitor;
use Doctrine\Common\Collections\Expr\Value;

class MongoDbExpressionVisitor extends ExpressionVisitor
{

    private $result;

    public function __construct()
    {
        $this->result = [];
    }

    /**
     * Converts a comparison expression into the target query language output.
     *
     * @param Comparison $comparison
     *
     * @return mixed
     */
    public function walkComparison(Comparison $comparison)
    {
        $this->result[] = [
            $comparison->getField(),
            $comparison->getOperator(),
            $comparison->getValue()
        ];
    }

    /**
     * Converts a value expression into the target query language part.
     *
     * @param Value $value
     *
     * @return mixed
     */
    public function walkValue(Value $value)
    {
        // TODO: Implement walkValue() method.
    }

    /**
     * Converts a composite expression into the target query language output.
     *
     * @param CompositeExpression $expr
     *
     * @return mixed
     */
    public function walkCompositeExpression(CompositeExpression $expr)
    {
        // TODO: Implement walkCompositeExpression() method.
    }

    public function getResult() {
        return $this->result;
    }
}