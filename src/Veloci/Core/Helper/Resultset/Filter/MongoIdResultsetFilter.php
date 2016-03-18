<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 22:29
 */

namespace Veloci\Core\Helper\Resultset\Filter;


class MongoIdResultsetFilter implements ResultsetFilter
{

    /**
     * @param array $input
     * @return array
     */
    public function apply(array &$input)
    {
        if (array_key_exists('_id', $input)) {
            $input['id'] = (string)$input['_id'];
            unset($input['_id']);
        }
    }
}