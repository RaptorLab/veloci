<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 17:46
 */

namespace Veloci\Core\Helper\Resultset\Filter;


interface ResultsetFilter
{
    /**
     * @param array $input
     */
    public function apply(array &$input);
}