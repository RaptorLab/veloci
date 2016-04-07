<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 17:37
 */

namespace Veloci\Core\Helper\Resultset;


use Veloci\Core\Helper\Resultset\Filter\ResultsetFilter;

interface Resultset extends \Iterator
{
    /**
     * @param ResultsetFilter $filter
     */
    public function appendFilter (ResultsetFilter $filter);

    /**
     * @return array
     */
    public function toArray():array;

    /**
     * @return mixed
     */
    public function getNextElement();
}