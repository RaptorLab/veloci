<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 14:45
 */

namespace Veloci\Core\Helper\Metadata\Domain;


class BooleanDomain extends AbstractDomain
{

    /**
     * @param $value
     * @return bool
     */
    public function validate($value):bool
    {
        $acceptedValue = [1, 0, 'true', 'false'];

        return is_bool($value) || in_array($value, $acceptedValue, true);
    }

    public function getType():string
    {
        return 'bool';
    }
}