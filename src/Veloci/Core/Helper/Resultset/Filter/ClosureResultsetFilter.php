<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 22:03
 */

namespace Veloci\Core\Helper\Resultset\Filter;


use Closure;

class ClosureResultsetFilter implements ResultsetFilter
{
    /**
     * @var Closure
     */
    private $closure;

    /**
     * ClosureResultsetFilter constructor.
     * @param Closure $closure
     */
    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @param array $input
     * @return array
     */
    public function apply(array &$input)
    {
        $this->closure->call($this, $input);
    }
}